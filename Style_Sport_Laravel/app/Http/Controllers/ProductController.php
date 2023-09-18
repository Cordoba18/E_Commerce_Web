<?php

namespace App\Http\Controllers;

//Importo modelos
use App\Models\Calification;
use App\Models\Category;
use App\Models\Color;
use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\Size;
//Importo el metodo que me permite consultar a la base de datos
use Illuminate\Support\Facades\DB;
//Importo el request para los parametros por POST
use Illuminate\Http\Request;
//Importo FacedesAuth para obtener los datos del usuario autentificado
use Illuminate\Support\Facades\Auth as FacadesAuth;
class ProductController extends Controller
{

    //Este metodo recibe un request de una busqueda para mostrar los productos buscados
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
    //Este medoto returna la vista de la pagina del producto con sus datos
    public function show(Product $product)
    {
        $category = Category::where('id',$product->categoria)->first();

        $imgs = ImgProduct::where('id_producto', $product->id)->where('estados_id','1')->get();

        $color = Color::where('id_producto', $product->id)->where('estados_id','1')->get();

        $size = Size::where('id_producto', $product->id)->where('estados_id','1')->get();
        $state = DB::selectOne("SELECT p.estados_id FROM productos p WHERE id = $product->id");
        $porcentaje = $product->precio*$product->descuento / 100;
        $discount = $product->precio - $porcentaje;
        $imgProduct = ImgProduct::all();
        $Products = Product::where('estados_id','1')->where('categoria',$product->categoria)->inRandomOrder()->limit(15)->get();
        return view('products.productProfile', compact('imgProduct','Products','product','category','imgs','color', 'size', 'discount', 'state'));
    }

    //Este metodo me permite calificar un producto respondiendo a una ruta la cual pide un request por metodo POST
    public function calificar(Request $request){
        //Aqui valido si el usuario esta autentificado para calificar. Si no esta autentificado no puede calificar
        if (FacadesAuth::user() == false || FacadesAuth::user() == null) {
            return response()->json(['message' => false], 200);
        } else {
            //Si esta autentificado obtengo su id
            $id_user = FacadesAuth::user()->id;
            $suma = false;
            //Busco si existe una calificacion del usuario para ese producto si existe lo que hago es editar la calificacion si no creo la nueva calificacion
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

            //Aqui hago el calculo de las calificaciones sacando su promedio y el numero de personas que calificaron para guardarlo en la base de datos y aplicarlo al producto
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
