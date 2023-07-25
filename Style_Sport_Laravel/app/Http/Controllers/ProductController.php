<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $productos = Product::where('estados_id', '1')->paginate(3);
        } else {
            $productos = DB::table('productos')
            ->join('categorias', 'productos.categoria', '=', 'categorias.id')
            ->select('productos.*')
            ->where(function($query) use ($search) {
                $query->where('productos.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('productos.descripcion', 'LIKE', '%' . $search . '%')
                    ->orWhere('categorias.categoria', 'LIKE', '%' . $search . '%');
            })
            ->where('estados_id','1')
            ->paginate(3);
        }
        $categories = Category::all();
        $imgProduct = ImgProduct::all();
        return view('products.productCatalog', compact('productos','categories','search','imgProduct'));
    }

    public function show(Product $product)
    {
        $category = Category::where('id',$product->categoria)->first();

        $imgs = ImgProduct::where('id_producto', $product->id)->where('estados_id','1')->get();

        $color = Color::where('id_producto', $product->id)->where('estados_id','1')->get();

        $size = Size::where('id_producto', $product->id)->where('estados_id','1')->get();

        
        return view('products.productProfile', compact('product','category','imgs','color', 'size'));
    }
}
