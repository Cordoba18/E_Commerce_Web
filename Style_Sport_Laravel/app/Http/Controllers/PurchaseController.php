<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Buys;
use App\Models\CartShop;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id = FacadesAuth::user()->id;
        $user = FacadesAuth::user()->correo;
        $direccion = FacadesAuth::user()->direccion;
        $telefono = FacadesAuth::user()->telefono;
        $departamentos =DB::select("SELECT* FROM Departamento");
        $Imagenes_productos =DB::select("SELECT* FROM Imagenes_productos");
        $productos = DB::select("SELECT* FROM productos");
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 3");
        if ($carrito) {
            return view('shopping.purchaseForm', compact('carrito','Imagenes_productos','productos','id', 'user', 'telefono', 'direccion', 'departamentos'));
        }else {
            return redirect()->route('shoppingcart');
        }

    }

    public function show()
    {
        return view('shopping.purchaseConfirmation');
    }


    public function facturar(Request $request)
    {
        //$fechaHoraActual = Carbon::now()->toRfc850String(); esto servira para las monitorias
        $id_usuario = FacadesAuth::user()->id;
        $fechaHoraActual = Carbon::now();
        $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id_usuario AND estados_id = 3");
        $total = 0;
        foreach ($carrito as $c) {
            $total = $total + $c->total * $c->cantidad_producto;
        }
        $factura =  new Bill();
        $factura->total = $total;
        $factura->fecha=$fechaHoraActual;
        $factura->id_user=$id_usuario;
        $factura->save();

        $factura_creada = DB::select("SELECT * FROM factura WHERE id_user = $id_usuario AND fecha = '$fechaHoraActual'");
        foreach ($carrito as $c){
            $talla_origen = Size::find($c->tallas_id);
            $talla_origen->cantidad = $talla_origen->cantidad - $c->cantidad_producto;
            $talla_origen->save();

            $talla_origen = Size::find($c->tallas_id);

            if ($talla_origen->cantidad <= 0) {
                $talla_origen->estados_id = 2;
                $talla_origen->save();
                DB::select("UPDATE `carrito_compras` SET `estados_id`='2' WHERE tallas_id = $c->tallas_id");
            }else {
                $carrito_2 = DB::select("SELECT * FROM carrito_compras WHERE tallas_id = $c->tallas_id");

                foreach($carrito_2 as $c2){

                    if ($talla_origen->cantidad < $c2->cantidad_producto) {
                        DB::select("UPDATE `carrito_compras` SET `cantidad_producto`=$talla_origen->cantidad WHERE id=$c2->id");
                    }
                }
            }
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
        DB::select("UPDATE `carrito_compras` SET `estados_id`='2' WHERE id_user = $id_usuario AND estados_id = 3");
        $paymentData = $request->input('paymentData');
        return response()->json(['message' => 'Datos recibidos con éxito'], 200);

    }

    public function validar(){
        $id = FacadesAuth::user()->id;
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 3");
        return response()->json(['seleccionados' => $carrito], 200);
    }


    public function save_changes(Request $request){

        $id = FacadesAuth::user()->id;

        DB::select("UPDATE `Users` SET `telefono`='$request->telefono',`direccion`='$request->direccion', `id_ciudad`='$request->ciudad' WHERE id=$id");
        return response()->json(['mensaje' => true], 200);
    }

    public function cargarciudades($id){

        $ciudades = DB::select("SELECT * FROM Ciudad WHERE id_departamento = $id");

        return response()->json(['ciudades' => $ciudades], 200);
    }
}
