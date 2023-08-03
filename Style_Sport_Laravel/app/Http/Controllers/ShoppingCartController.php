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
        $Imagenes_productos =DB::select("SELECT* FROM Imagenes_productos");
        $productos = DB::select("SELECT* FROM productos");
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 1");
        return view('shopping.shoppingCart', compact('carrito','Imagenes_productos','productos','id'));
    }

    public function store(StoreProductCartShopping $request)
    {

   // $existences = CartShop::where('id_producto', $request->product)->where('tallas_id', $request->size)->where('id_user', $request->user)->where('estados_id', '1')->get();

    //if ($existences){
       // $size = Size::where('id',$request->size)->where('id_producto', $request->product)->first();
        //if ($existences->cantidad_producto <= $size->cantidad) {
       //     dd('ingrese');
       // }
 //   }

    $cartshop = CartShop::create([
        'cantidad_producto' => $request->amount,
        'total' => $request->price,
        'id_user' => $request->user,
        'id_producto' =>$request->product,
        'estados_id' => '1',
        'tallas_id' => $request->size,
        'colores_id' => $request->color,
       ]);


       return redirect('productprofile/'.$request->product);


    }
    public function delete($id) {
        $carrito = CartShop::find($id);
        $carrito->estados_id =2;
        $carrito->save();
}

public function editquantity(HttpRequest $request){
    $id = $request->id;
    $carrito = CartShop::find($id);
    $carrito->cantidad_producto = $request->cantidad;
    $carrito->save();

}

public function comprar(){
    $id = FacadesAuth::user()->id;
    $seleccionados = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id=3");

    if ( $seleccionados) {
        return redirect()->route('paymentmethod');
    }else{
        return redirect()->route('shoppingcart')->with('mensaje', 'NO SE AGREGO');
    }
}

public function cancelar_seleccion($id){
    $carrito = CartShop::find($id);
    $carrito->estados_id = 1;
    $carrito->save();

}

public function seleccionar($id){
    $carrito = CartShop::find($id);
    $carrito->estados_id = 3;
    $carrito->save();
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



