<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BuyController extends Controller
{
    public function obtenerComprasPorFactura($id_user, $factura_id){
        $resultados = DB::select(
            'SELECT c.total, c.id, p.nombre, c.cantidad, t.talla, colors.color, c.colores_id, es.estado
            FROM compra c
            INNER JOIN productos p ON c.id_producto = p.id
            INNER JOIN tallas t ON c.tallas_id = t.id
            INNER JOIN colores colors ON c.colores_id = colors.id
            INNER JOIN estados es ON c.estados_id = es.id
            WHERE c.id_user = ? AND c.factura_id = ?',
            [$id_user, $factura_id]);

        return response()->json($resultados);
    }
}
