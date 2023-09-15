<?php

namespace App\Http\Controllers;

use App\Models\Bill;

class BillController extends Controller{

    public function obtenerFacturasPorUsuario($id_user){
        $facturas = Bill::where('id_user', $id_user)->get();
        return response()->json($facturas);
    }
}
