<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCartShopping;
use App\Models\CartShop;
use App\Models\Product;
use App\Models\Size;

class ShoppingCartController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        return view('shopping.shoppingCart');
    }

    public function store(StoreProductCartShopping $request)
    {

    $existences = CartShop::where('id_producto', $request->product)->where('tallas_id', $request->size)->where('id_user', $request->user)->where('estados_id', '1')->get();

    if ($existences){
        $size = Size::where('id',$request->size)->where('id_producto', $request->product)->first();
        if ($existences->cantidad_producto <= $size->cantidad) {
            dd('ingrese');
        }
    }


    

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