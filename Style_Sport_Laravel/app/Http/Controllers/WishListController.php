<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use App\Models\WihsList;
class WishListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = FacadesAuth::user()->id;
        $lista_deseos = DB::select(" SELECT l.id_producto, p.nombre, l.id, p.precio FROM lista_deseos l
        INNER JOIN productos p ON l.id_producto = p.id
        WHERE l.id_user = $id AND l.estados_id=1");
        $Imagenes_productos =DB::select("SELECT * FROM Imagenes_productos WHERE estados_id = 1");
        return view('products.wishList', compact('lista_deseos', 'Imagenes_productos', 'id'));
    }


    public function store($id_producto){
        $id = FacadesAuth::user()->id;
        $validar = DB::select(" SELECT * FROM lista_deseos WHERE id_user = $id AND id_producto=$id_producto AND estados_id =1");
        if ($validar) {
            return redirect('productprofile/'.$id_producto);
        }else {

            $cartshop = WihsList::create([
                'id_user' => $id,
                'id_producto' => $id_producto,
                'estados_id' => '1',
               ]);
               return redirect('productprofile/'.$id_producto);

        }
    }

    public function delete($id_lista_deseos){
        $id = FacadesAuth::user()->id;

        DB::select("UPDATE `lista_deseos` SET `estados_id`='2' WHERE id_user=$id AND id=$id_lista_deseos");
    }
}
