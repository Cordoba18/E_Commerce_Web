<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.productCatalog');
    }

    public function show()
    {
        return view('products.productProfile');
    }

    public function search(Request $request)
    {
        $productos = DB::select("select * from productos INNER JOIN categorias on productos.categoria = categorias.id WHERE productos.nombre LIKE '%$request->search%' OR productos.descripcion LIKE '%$request->search%' or categorias.nombre_categoria LIKE '%$request->search%'");
        return view('products.productCatalog', compact('productos'));
    }
}
