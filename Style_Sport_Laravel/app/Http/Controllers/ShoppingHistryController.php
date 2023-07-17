<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingHistryController extends Controller
{
    public function index()
    {
        return view('customers.shoppingHistry');
    }
}
