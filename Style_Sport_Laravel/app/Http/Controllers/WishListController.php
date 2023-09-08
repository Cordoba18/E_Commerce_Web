<?php

namespace App\Http\Controllers;
//importar clase que me permite validar la autenticacion del usuario
use Illuminate\Support\Facades\Auth as FacadesAuth;
//importar funcion para hacer consulta a la base de datos
use Illuminate\Support\Facades\DB;
//importo modelo
use App\Models\WihsList;
class WishListController extends Controller
{
//funcion que me permite validar la autenticacion del usuario
    public function __construct()
    {
        $this->middleware('auth');
    }
//funcion que responde a una ruta y muestra la lista de deseos enviando la lista de deseos, la imagenes de los productos y el id del usuario
    public function index()
    {
        $id = FacadesAuth::user()->id;
        $lista_deseos = DB::select(" SELECT l.id_producto, p.nombre, l.id, p.precio FROM lista_deseos l
        INNER JOIN productos p ON l.id_producto = p.id
        WHERE l.id_user = $id AND l.estados_id=1");
        $Imagenes_productos =DB::select("SELECT * FROM Imagenes_productos WHERE estados_id = 1");
        return view('products.wishList', compact('lista_deseos', 'Imagenes_productos', 'id'));
    }

//funcion que responde a una ruta la cual guarda el producto en la lista de deseos
    public function store($id_producto){
        //se valida si el producto esta inactivo en la base de datos si esta inactivo le muestra un mensaje de error
        if (DB::select("SELECT * FROM productos WHERE id = $id_producto AND estados_id = 2")) {
            return redirect('productprofile/'.$id_producto)->with('inactivo', true);
          }else{
            //como no se cumplio la exepcion se procede a hacer la insercion
            //capturo el id del usuario de su sesion
            $id = FacadesAuth::user()->id;
            //se valida si el producto ya esta en la lista, si no esta lo crea normalmente
        $validar = DB::select(" SELECT * FROM lista_deseos WHERE id_user = $id AND id_producto=$id_producto AND estados_id =1");
        if ($validar) {
            return redirect('productprofile/'.$id_producto)->with('list', true);
        }else {

            $cartshop = WihsList::create([
                'id_user' => $id,
                'id_producto' => $id_producto,
                'estados_id' => '1',
               ]);
               return redirect('productprofile/'.$id_producto)->with('list', true);

        }
    }
    }
//funcion que responde a una ruta y recibe el id de un producto de la lista de deseos y lo elimina
    public function delete($id_lista_deseos){
        $id = FacadesAuth::user()->id;

        DB::select("UPDATE `lista_deseos` SET `estados_id`='2' WHERE id_user=$id AND id=$id_lista_deseos");
    }
}
