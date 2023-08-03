<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id = FacadesAuth::user()->id;
        $Imagenes_productos =DB::select("SELECT* FROM Imagenes_productos");
        $productos = DB::select("SELECT* FROM productos");
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 3");
        return view('shopping.purchaseForm', compact('carrito','Imagenes_productos','productos','id'));
    }

    public function show()
    {
        return view('shopping.purchaseConfirmation');
    }
}
