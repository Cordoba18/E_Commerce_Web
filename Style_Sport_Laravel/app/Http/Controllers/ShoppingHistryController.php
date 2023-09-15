<?php

namespace App\Http\Controllers;
//importar clase que me permite validar la autenticacion del usuario
use Illuminate\Support\Facades\Auth as FacadesAuth;
//importar funcion para hacer consulta a la base de datos
use Illuminate\Support\Facades\DB;
class ShoppingHistryController extends Controller
{
//funcion que me permite validar la autenticacion del usuario
    public function __construct()
    {
        $this->middleware('auth');
    }
    //funcion que responde a una ruta la cual muestra las facturas del usuario
    public function index()
    {
        $id = FacadesAuth::user()->id;
        $factura = DB::select("SELECT * FROM factura WHERE id_user = $id");
        return view('customers.shoppingHistry', compact('factura'));
    }
}
