<?php

namespace App\Http\Controllers;

//Importo modelos
use App\Models\Bill;
use App\Models\Buys;
use App\Models\Size;
//Importo request para usar los parametros por metodo POST
use Illuminate\Http\Request;
//Importo FacedesAuth para obtener los datos del usuario autentificado
use Illuminate\Support\Facades\Auth as FacadesAuth;
//Importo el metodo que me permite consultar a la base de datos
use Illuminate\Support\Facades\DB;
//Importo carbon para el cual me ayuda a obtener la fecha y hora actual
use Carbon\Carbon;
//Importo una clase la cual me permite enviar la factura por correo
use App\Mail\factureEmail;
//Importo un metodo que permite enviar la informacion para el correo
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
//Verificacion de autenticacion
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Este metodo responde a la ruta principal para el formulario de la compra en la cual pido los datos del carrito y valido si tiene productos para comprar si no lo devuelve alcarrito
    //Tambien capturo los datos del usuario atentificado para validar su informacion
    public function index()
    {
        $id = FacadesAuth::user()->id;
        $user = FacadesAuth::user()->correo;
        $direccion = FacadesAuth::user()->direccion;
        $telefono = FacadesAuth::user()->telefono;
        $N_Identificacion = FacadesAuth::user()->N_Identificacion;
        $departamentos =DB::select("SELECT* FROM Departamento");
        $Imagenes_productos =DB::select("SELECT* FROM Imagenes_productos");
        $productos = DB::select("SELECT* FROM productos");
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 3");
        if ($carrito) {
            return view('shopping.purchaseForm', compact('carrito','Imagenes_productos','productos','id', 'user', 'telefono', 'direccion', 'departamentos', 'N_Identificacion'));
        }else {
            return redirect()->route('shoppingcart');
        }

    }

//Este metodo responde una ruta la cual realiza la facturizacion, envio de correo, disminucion de tallas, desactivacion de carritos y creacion de detalles de facutras
    public function facturar(Request $request)
    {
        //$fechaHoraActual = Carbon::now()->toRfc850String(); esto servira para las monitorias
        //capturo id del usuario
        $id_usuario = FacadesAuth::user()->id;
        //capturo la fecha y la hora actual
        $fechaHoraActual = Carbon::now('America/Bogota');
        //busco todos los productos que se compraron del carrito
        $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id_usuario AND estados_id = 3");
        $total = 0;
        //recorro ese carrito para sacar el total
        foreach ($carrito as $c) {
            $total = $total + $c->total * $c->cantidad_producto;
        }
        //creo la factura
        $factura =  new Bill();
        $factura->total = $total;
        $factura->fecha=$fechaHoraActual;
        $factura->id_user=$id_usuario;
        $factura->save();

        //obtengo esa facura creada
        $factura_creada = DB::select("SELECT * FROM factura WHERE id_user = $id_usuario AND fecha = '$fechaHoraActual'");
        //disminuyo la cantidad de la talla de los productos comprados
        foreach ($carrito as $c){
            $talla_origen = Size::find($c->tallas_id);
            $talla_origen->cantidad = $talla_origen->cantidad - $c->cantidad_producto;
            $talla_origen->save();

            $talla_origen = Size::find($c->tallas_id);
        //valido si la talla quedo siendo igual a 0 para inactivarla y inactivarla de los carritos
            if ($talla_origen->cantidad <= 0) {
                $talla_origen->estados_id = 2;
                $talla_origen->save();
                DB::select("UPDATE `carrito_compras` SET `estados_id`='2' WHERE tallas_id = $c->tallas_id");
            }else {
                //traigo todos los carritos que tenga la talla para editar su talla y poner la mas alta disponible en cada uno de los carritos
                $carrito_2 = DB::select("SELECT * FROM carrito_compras WHERE tallas_id = $c->tallas_id");

                foreach($carrito_2 as $c2){

                    if ($talla_origen->cantidad < $c2->cantidad_producto) {
                        DB::select("UPDATE `carrito_compras` SET `cantidad_producto`=$talla_origen->cantidad WHERE id=$c2->id");
                    }
                }
            }
            //guardo los productos comprados para la factura
            $compra = new Buys();
            $compra->id_user = $id_usuario;
            $compra->id_producto = $c->id_producto;
            $compra->total = $c->total;
            $compra->cantidad = $c->cantidad_producto;
            foreach($factura_creada as $f){
                $compra->factura_id = $f->id;
            }
            $compra->tallas_id = $c->tallas_id;
            $compra->colores_id = $c->colores_id;
            $compra->estados_id = 4;
            $compra->save();
        }
        //los productos comprados del carrito del usuario los pongo inactivos para que ya no aparezcan en el carrito
        DB::select("UPDATE `carrito_compras` SET `estados_id`='2' WHERE id_user = $id_usuario AND estados_id = 3");
        //envio la fecha de la factura para enviar el correo
        Mail::to(FacadesAuth::user()->correo)->send(new factureEmail($fechaHoraActual));
        //respondo que se cumplio con exito la compra
        return response()->json(['message' => 'Datos recibidos con éxito'], 200);

    }
//Este metodo responde a una ruta para validar para obtener los datos de todos los productos a comprar
    public function validar(){
        $id = FacadesAuth::user()->id;
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 3");
        return response()->json(['seleccionados' => $carrito], 200);
    }

//Este metodo responde a una ruta y lo que hace es editar los datos del usuario previos a la compra
    public function save_changes(Request $request){
        $id = FacadesAuth::user()->id;
        DB::select("UPDATE `Users` SET `telefono`='$request->telefono',`direccion`='$request->direccion', `id_ciudad`='$request->ciudad', `N_Identificacion`='$request->identificacion' WHERE id=$id");
        return response()->json(['mensaje' => true], 200);
    }
//Este metodo responde a una ruta y returna las ciudades del id del departamento que resive
    public function cargarciudades($id){

        $ciudades = DB::select("SELECT * FROM Ciudad WHERE id_departamento = $id");

        return response()->json(['ciudades' => $ciudades], 200);
    }
}
