<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ImgProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $productos = Product::paginate(3);
        } else {
            $productos = DB::table('productos')
            ->join('categorias', 'productos.categoria', '=', 'categorias.id')
            ->select('productos.*')
            ->where('productos.nombre', 'LIKE', '%' . $search . '%')
            ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
            ->orWhere('categorias.categoria', 'LIKE', '%' . $search . '%')
            ->paginate(3);
        }
        $categories = Category::all();
        $imgProduct = ImgProduct::all();
        return view('products.productCatalog', compact('productos','categories','search','imgProduct'));
    }

    public function show()
    {
        return view('products.productProfile');
    }
}
