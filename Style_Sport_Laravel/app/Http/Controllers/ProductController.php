<?php

namespace App\Http\Controllers;

use App\Models\Calification;
use App\Models\Category;
use App\Models\Color;
use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $productos = Product::where('estados_id', '1')->paginate(15);
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
            ->paginate(15);
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

        $porcentaje = $product->precio*$product->descuento / 100;
        $discount = $product->precio - $porcentaje;

        $imgProduct = ImgProduct::all();
        $Products = Product::where('estados_id','1')->where('categoria',$product->categoria)->inRandomOrder()->limit(15)->get();
        return view('products.productProfile', compact('imgProduct','Products','product','category','imgs','color', 'size', 'discount'));
    }


    public function calificar(Request $request){
        if (FacadesAuth::user() == false || FacadesAuth::user() == null) {
            return response()->json(['message' => false], 200);
        } else {
            $id_user = FacadesAuth::user()->id;
            $suma = false;
            $buscar = DB::selectOne("SELECT * FROM calificacion WHERE id_user = $id_user AND id_producto = $request->id_producto");
            if ($buscar) {
                DB::update("UPDATE `calificacion` SET `calificacion`='$request->valoracion' WHERE id = $buscar->id");
            }else {
                $tbl_calificacion = new Calification();
                $tbl_calificacion->id_user = $id_user;
                $tbl_calificacion->id_producto = $request->id_producto;
                $tbl_calificacion->calificacion = $request->valoracion;
                $tbl_calificacion->save();
                $suma = true;
            }

            $producto = Product::find($request->id_producto);
            $buscar = DB::select("SELECT * FROM calificacion WHERE id_producto = $request->id_producto");
            $calificaciones = 0;
            $numero_personas = 0;
            foreach ($buscar as $b){
                $calificaciones = $calificaciones + $b->calificacion;
                $numero_personas = $numero_personas + 1;
            }
            $promedio_calificacion = $calificaciones/$numero_personas;
            $producto->calificacion = $promedio_calificacion;
            $producto->n_p_calificaron = $numero_personas;
            $producto->save();
        }
        return response()->json(['message' => true], 200);
        }


}
