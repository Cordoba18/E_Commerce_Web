<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class ProductController extends Controller
{
    public function index()
    {
        
        if (session('search')) {
            $search = session('search');

            if ($search == '') {
                $productos = Product::all();
            } else {
                 $productos = DB::select("select * from productos INNER JOIN categorias on productos.categoria = categorias.id 
                 WHERE productos.nombre LIKE '%$search%' OR productos.descripcion LIKE '%$search%' or categorias.categoria LIKE '%$search%'");
            }
        } else  if (session('category'))  {
            $category =  session('category');
            $productos = Product::where('categoria', $category->id)->get();
        } else {
            $productos = Product::all();
        }
        $categories = Category::all();

        return view('products.productCatalog', compact('productos','categories'));
    }

    public function show()
    {
        return view('products.productProfile');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        return redirect()->route('productcatalog')->with('search', $search);
    }

    public function searchCategory(String $id)
    {
        $category = Category::where('id', $id)->first();
        return redirect()->route('productcatalog')->with('category', $category);
    }
}
