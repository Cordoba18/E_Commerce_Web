<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        return view('shopping.shoppingCart');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
