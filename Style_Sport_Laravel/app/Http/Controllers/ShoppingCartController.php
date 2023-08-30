<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use App\Http\Requests\StoreProductCartShopping;
use App\Models\CartShop;
use App\Models\Product;

use App\Models\Size;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class ShoppingCartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $id = FacadesAuth::user()->id;
        DB::select("UPDATE `carrito_compras` SET `estados_id`='1' WHERE id_user = $id AND estados_id = 3");
        $imgProduct =DB::select("SELECT* FROM Imagenes_productos WHERE estados_id = 1");
        $carro_a_validar = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id = 1");
        foreach($carro_a_validar as $c){
            $talla_origen = Size::find($c->tallas_id);

            if ($talla_origen->cantidad < $c->cantidad_producto) {
                DB::select("UPDATE `carrito_compras` SET `cantidad_producto`='1' WHERE id=$c->id");
            }
        }
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto, c.tallas_id FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 1");
        $Products = Product::Where('estados_id', '1')->inRandomOrder()->limit(15)->get();
        return view('shopping.shoppingCart', compact('carrito','imgProduct','id', 'Products'));
    }

    public function store(StoreProductCartShopping $request)
    {

      if (DB::select("SELECT * FROM productos WHERE id = $request->product AND estados_id = 2")) {
        return redirect('productprofile/'.$request->product)->with('inactivo', true);
      }else{
        $id = FacadesAuth::user()->id;
        $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id = 1 AND id_producto = $request->product AND tallas_id = $request->size");
        if ($carrito) {
            $talla_origen = Size::find($request->size);
            $total_cantidad = 0;
            foreach($carrito as $c){
                    $total_cantidad = $total_cantidad + $c->cantidad_producto;
                    if ($c->colores_id == $request->color) {
                        $carro = CartShop::find($c->id);
                        $carro->cantidad_producto =$request->amount;
                        $carro->save();
                        return redirect('productprofile/'.$request->product)->with('cart', true);
                    }else
                    if ($total_cantidad+$request->amount > $talla_origen->cantidad) {
                        return redirect('productprofile/'.$request->product)->with('no-cart', true);
                    }
            }




        $cartshop = CartShop::create([
            'cantidad_producto' => $request->amount,
            'total' => $request->price,
            'id_user' => $request->user,
            'id_producto' =>$request->product,
            'estados_id' => '1',
            'tallas_id' => $request->size,
            'colores_id' => $request->color,
           ]);
           return redirect('productprofile/'.$request->product)->with('cart', true);
        }else {
            $cartshop = CartShop::create([
                'cantidad_producto' => $request->amount,
                'total' => $request->price,
                'id_user' => $request->user,
                'id_producto' =>$request->product,
                'estados_id' => '1',
                'tallas_id' => $request->size,
                'colores_id' => $request->color,
               ]);
               return redirect('productprofile/'.$request->product)->with('cart', true);
        }
    }




    }
    public function delete($id) {
        $carrito = CartShop::find($id);
        $carrito->estados_id =2;
        $carrito->save();
}

public function editquantity(HttpRequest $request){
    $id = $request->id;
    $id_user = FacadesAuth::user()->id;
    $talla_origen = Size::find($request->tallas_id);
    $total_cantidad = 0;
    $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id_user AND estados_id = 1 AND tallas_id = $request->tallas_id AND id <> $id");
            foreach($carrito as $c){
                    $total_cantidad = $total_cantidad + $c->cantidad_producto;
                    if ($total_cantidad+$request->cantidad > $talla_origen->cantidad) {
                        return response()->json(['message' => false], 200);
                    }
            }
    $carrito = CartShop::find($id);
    $talla_origen = Size::find($carrito->tallas_id);
    if ($talla_origen->cantidad >= $request->cantidad) {
        $carrito->cantidad_producto = $request->cantidad;
        $carrito->save();
        return response()->json(['message' => true], 200);
    }else {
        return response()->json(['message' => false], 200);
    }
}

public function comprar(){
    $id = FacadesAuth::user()->id;
    $seleccionados = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id=3");

    if ( $seleccionados) {
        return redirect()->route('purchaseform');
    }else{
        return redirect()->route('shoppingcart')->with('mensaje', 'NO SE AGREGO');
    }
}

public function cancelar_seleccion($id){
    $carrito = CartShop::find($id);
    if ($carrito->estados_id == 2) {
        return response()->json(['message' => false], 200);
    }else{
    $carrito->estados_id = 1;
    $carrito->save();
    return response()->json(['message' => true], 200);
    }
}

public function seleccionar($id){
    $carrito = CartShop::find($id);
    if ($carrito->estados_id == 2) {
        return response()->json(['message' => false], 200);
    }else{
    $carrito->estados_id = 3;
    $carrito->save();
    return response()->json(['message' => true], 200);
    }
}

public function calcular(){

    $id = FacadesAuth::user()->id;
    $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id=1");
    $total = 0;
    foreach($carrito as $c){

        $total = $total + ($c->total * $c->cantidad_producto);
    }
    return response()->json(['message' => number_format(intval(round($total)))], 200);
}
}





    //    $cartshop = CartShop::create([
    //     'cantidad_producto' => $request->amount,
    //     'total' => $request->price,
    //     'id_user' => $request->user,
    //     'id_producto' =>$request->product,
    //     'estados_id' => '1',
    //     'tallas_id' => $request->size,
    //     'colores_id' => $request->color,
    //    ]);
    // return redirect('productprofile/'.$request->product);



