<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
class ShoppingHistryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        
        $id = FacadesAuth::user()->id;
       $factura = DB::select("SELECT * FROM factura WHERE id_user = $id");
        return view('customers.shoppingHistry', compact('factura'));
    }
}
