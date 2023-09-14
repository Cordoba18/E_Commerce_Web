<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ImgProduct;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // lo que hacemos aqui es obtener el contenido para la pagina inicial, buscamos productos categorias y imagenes del slider
        $Product_desc = Product::Where('estados_id', '1')->inRandomOrder()->limit(15)->get();
        $Product = Product::Where('estados_id', '1')->where('descuento' ,'>', 0)->inRandomOrder()->limit(15)->get();
        $Product_novedades = Product::Where('estados_id', '1')->orderByDesc('id')->limit(15)->get();
        $imgProduct = ImgProduct::Where('estados_id', '1')->get();
        $slider = Slider::Where('estados_id', '1')->get();
        $categorys = DB::select("SELECT c.categoria, MAX(p.id) AS id
        FROM categorias c
        INNER JOIN productos p ON c.id = p.categoria
        WHERE p.estados_id = 1
        GROUP BY c.categoria");
        
        // retornamos al inicio y enviamos todos los datos
        return view('homePage', compact('Product', 'slider','imgProduct','Product_novedades', 'Product_desc', 'categorys'));
    }
}
