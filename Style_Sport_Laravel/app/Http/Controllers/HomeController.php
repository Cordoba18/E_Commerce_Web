<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ImgProduct;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $Product_desc = Product::Where('estados_id', '1')->inRandomOrder()->limit(15)->get();
        $Product = Product::Where('estados_id', '1')->inRandomOrder()->limit(15)->get();
        $Product_novedades = Product::Where('estados_id', '1')->orderByDesc('id')->limit(15)->get();
        $imgProduct = ImgProduct::Where('estados_id', '1')->get();
        $slider = Slider::Where('estados_id', '1')->get();
        return view('homePage', compact('Product', 'slider','imgProduct','Product_novedades', 'Product_desc'));
    }
}
