<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use App\Http\Requests\StoreProductCartShopping;
use App\Models\CartShop;
use App\Models\Product;
<<<<<<< HEAD
use App\Models\Size;
=======
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
>>>>>>> 0903eb43bae793d8ec0832d96c79c4e56359037b

class ShoppingCartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $id = FacadesAuth::user()->id;
        $Imagenes_productos =DB::select("SELECT* FROM Imagenes_productos");
        $productos = DB::select("SELECT* FROM productos");
        $carrito = DB::select("SELECT c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 1");
        return view('shopping.shoppingCart', compact('carrito','Imagenes_productos','productos','id'));
    }

    public function store(StoreProductCartShopping $request)
    {

<<<<<<< HEAD
    $existences = CartShop::where('id_producto', $request->product)->where('tallas_id', $request->size)->where('id_user', $request->user)->where('estados_id', '1')->get();

    if ($existences){
        $size = Size::where('id',$request->size)->where('id_producto', $request->product)->first();
        if ($existences->cantidad_producto <= $size->cantidad) {
            dd('ingrese');
        }
    }


    

    }
}


    //    $cartshop = CartShop::create([
    //     'cantidad_producto' => $request->amount,
    //     'total' => $request->price,
    //     'id_user' => $request->user,
    //     'id_producto' =>$request->product,
    //     'estados_id' => '1',
    //     'tallas_id' => $request->size,
    //     'colores_id' => $request->color,
    //    ]);
    // return redirect('productprofile/'.$request->product);
=======
       $cartshop = CartShop::create([
        'cantidad_producto' => $request->amount,
        'total' => $request->price,
        'id_user' => $request->user,
        'id_producto' =>$request->product,
        'estados_id' => '1',
        'tallas_id' => $request->size,
        'colores_id' => $request->color,
       ]);


       return redirect('productprofile/'.$request->product);

    }
}
>>>>>>> 0903eb43bae793d8ec0832d96c79c4e56359037b
