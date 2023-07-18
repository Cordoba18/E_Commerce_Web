<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ImgProduct;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $Product = Product::all();
        $imgProduct = ImgProduct::all();
        $slider = Slider::all();
        return view('homePage', compact('Product', 'slider','imgProduct'));
    }
}
