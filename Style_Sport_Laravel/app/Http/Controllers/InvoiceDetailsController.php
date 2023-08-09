<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;
class InvoiceDetailsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id_factura){

        $id_user = FacadesAuth::user()->id;
        $detalles = DB::select("SELECT c.total, c.id, p.nombre, c.cantidad, t.talla, colors.color, c.colores_id FROM compra c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores colors ON c.colores_id = colors.id
        WHERE c.id_user = $id_user AND c.factura_id = $id_factura");

        return view('customers.InvoiceDetails', compact('detalles'));

    }


}
