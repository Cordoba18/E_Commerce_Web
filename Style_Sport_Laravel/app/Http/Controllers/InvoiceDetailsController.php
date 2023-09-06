<?php

namespace App\Http\Controllers;
//Importo el request para usarlos en caso de resivir datos por POST
use Illuminate\Http\Request;
//Importo un metodo de DB para hacer consultas casuales sql directamente a la base de datos.
use Illuminate\Support\Facades\DB;
//Importo FacedesAuth para obtener los datos del usuario autentificado
use Illuminate\Support\Facades\Auth as FacadesAuth;

class InvoiceDetailsController extends Controller
{

//Con este metodo validamos si el usuario esta autentificado para mostrarle la informacion o no
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Este metodo responde una ruta la cual pide el id de una factura para mostrar sus detalles y la factura en si
    public function index($id_factura){

        $id_user = FacadesAuth::user()->id;
        $detalles = DB::select("SELECT c.total, c.id, p.nombre, c.cantidad, t.talla, colors.color, c.colores_id FROM compra c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores colors ON c.colores_id = colors.id
        WHERE c.id_user = $id_user AND c.factura_id = $id_factura");
        $factura = DB::selectOne("SELECT * FROM factura WHERE id = $id_factura");
        return view('customers.InvoiceDetails', compact('detalles', 'factura'));

    }


}
