<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCartShopping;
use App\Models\CartShop;
use App\Models\Product;


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
        $product = Product::where('id', $request->product)->where('estados_id', '1')->first();

       $cartshop = CartShop::create([
        'cantidad_producto' => $request->amount,
        'total' => $request->price,
        'id_user' => $request->product,
        'id_producto' =>$request->user,
        'estados_id' => '1',
        'tallas_id' => $request->size,
        'colores_id' => $request->color,
       ]);


    }
}
