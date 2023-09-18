<?php

namespace App\Http\Controllers;
//importo modelos
use App\Models\CartShop;
use App\Models\Product;
use App\Models\Size;
//importo clase para validar el request del carrito
use App\Http\Requests\StoreProductCartShopping;
//importo el request con un alias que me permite manejar los parametros por POST
use Illuminate\Http\Request as HttpRequest;
//importo Auth con un alias para validar la sesion del usuario
use Illuminate\Support\Facades\Auth as FacadesAuth;
//importo metodo que me permite consultar a la base de datos
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
//funcion que valida la sesion del usuario
    public function __construct()
    {
        $this->middleware('auth');
    }
//funcion que responde a una ruta para mostrar el carrito del usuario
    public function index()
    {
        //capturo el id del usuario de la sesion
        $id = FacadesAuth::user()->id;
        //edito todo el carrito del usuario y pongo todos los productos que estan seleccionados los pongo activos para que se muestren en el carrito de nuevo
        DB::select("UPDATE `carrito_compras` SET `estados_id`='1' WHERE id_user = $id AND estados_id = 3");
        //capturo imagenes de productos de la base de datos
        $imgProduct =DB::select("SELECT* FROM Imagenes_productos WHERE estados_id = 1");
        //capturo los productos del carrito
        $carro_a_validar = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id = 1");
        //valido si la talla a disminuido para poner la talla minima en caso de que la talla del carrito sobrepase la original
        foreach($carro_a_validar as $c){
            $talla_origen = Size::find($c->tallas_id);

            if ($talla_origen->cantidad < $c->cantidad_producto) {
                DB::select("UPDATE `carrito_compras` SET `cantidad_producto`='1' WHERE id=$c->id");
            }
        }
        //capturar el carrito de compras para mostrarlo en la vista
        $carrito = DB::select("SELECT c.id, c.cantidad_producto, c.total, t.talla, color.color, p.nombre, t.cantidad AS cantidad_total, c.id_producto, c.tallas_id FROM carrito_compras c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores color ON c.colores_id = color.id
        WHERE c.id_user = $id AND c.estados_id = 1");
        //capturo los productos para el carusel de poductos que podrian interesarle al usuario
        $Products = Product::Where('estados_id', '1')->inRandomOrder()->limit(15)->get();

        return view('shopping.shoppingCart', compact('carrito','imgProduct','id', 'Products'));
    }

    //funcion que responde a una ruta para guardar el producto en el carrito
    public function store(StoreProductCartShopping $request)
    {

        //verifico si el producto que se quiere guardar esta inactivo
      if (DB::select("SELECT * FROM productos WHERE id = $request->product AND estados_id = 2")) {
        return redirect('productprofile/'.$request->product)->with('inactivo', true);
      }else{
        //capturo el id del usuario de su sesion
        $id = FacadesAuth::user()->id;
        //busco si existe un carrito con ese producto y esta talla
        $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id = 1 AND id_producto = $request->product AND tallas_id = $request->size");
        //Se valida si existe
        if ($carrito) {
            //si existe se valida si la cantidad que esta intentando poner esta disponible
            $talla_origen = Size::find($request->size);
            $total_cantidad = 0;
            foreach($carrito as $c){
                    $total_cantidad = $total_cantidad + $c->cantidad_producto;
                    if ($c->colores_id == $request->color) {
                        $carro = CartShop::find($c->id);
                        $carro->cantidad_producto =$request->amount;
                        $carro->save();
                        return redirect('productprofile/'.$request->product)->with('cart', true);
                        //si coincide el color edita la cantidad
                    }else
                    if ($total_cantidad+$request->amount > $talla_origen->cantidad) {
                        return redirect('productprofile/'.$request->product)->with('no-cart', true);
                        //se valida si la cantidad esta en el rango permitido ya que puede tener una cantidad con otro color en el carrito que no puede sobre pasar
                    }
            }

            //si no cumple nada de lo anterior crea el registro para el carrito con normalidad


        $cartshop = CartShop::create([
            'cantidad_producto' => $request->amount,
            'total' => $request->price,
            'id_user' => $request->user,
            'id_producto' =>$request->product,
            'estados_id' => '1',
            'tallas_id' => $request->size,
            'colores_id' => $request->color,
           ]);
           return redirect('productprofile/'.$request->product)->with('cart', true);
        }else {
            //si no existe el producto con esa talla lo crea con normalidad
            $cartshop = CartShop::create([
                'cantidad_producto' => $request->amount,
                'total' => $request->price,
                'id_user' => $request->user,
                'id_producto' =>$request->product,
                'estados_id' => '1',
                'tallas_id' => $request->size,
                'colores_id' => $request->color,
               ]);
               return redirect('productprofile/'.$request->product)->with('cart', true);
        }
    }




    }
    //funcion que responde a una ruta la cual inactiva el producto del carrito
    public function delete($id) {
        $carrito = CartShop::find($id);
        $carrito->estados_id =2;
        $carrito->save();
}

//funcion que edita la cantidad del carrito
public function editquantity(HttpRequest $request){
    //capturo el id del carrito del request
    $id = $request->id;
    //captura el id del usuario de su sesion
    $id_user = FacadesAuth::user()->id;
    //capturo la talla original de ese producto
    $talla_origen = Size::find($request->tallas_id);
    $total_cantidad = 0;

    if (DB::selectOne("SELECT * FROM carrito_compras c INNER JOIN productos p ON c.id_producto = p.id WHERE c.id=$id AND p.estados_id = 2")) {
        return response()->json(['message' => 'inhabilitado'], 200);
    }else{
    //verifico si la cantidad ingresada esta sobre pasando los limites de la cantidad original
    $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id_user AND estados_id = 1 AND tallas_id = $request->tallas_id AND id <> $id");
            foreach($carrito as $c){
                    $total_cantidad = $total_cantidad + $c->cantidad_producto;
                    if ($total_cantidad+$request->cantidad > $talla_origen->cantidad) {
                        //retorno de mensaje de desaprobacion
                        return response()->json(['message' => false], 200);
                    }
            }
//busco el carrito de nuevo para poder guardarlo directamente con el modelo
    $carrito = CartShop::find($id);
    $talla_origen = Size::find($carrito->tallas_id);
    //verifico de nuevo si la cantidad original del producto es mayor a la que se esta ingresando
    if ($talla_origen->cantidad >= $request->cantidad) {
        //guardo el producto
        $carrito->cantidad_producto = $request->cantidad;
        $carrito->save();
        //retorno de mensaje de aprobacion
        return response()->json(['message' => true], 200);
    }else {
               //retorno de mensaje de desaprobacion
        return response()->json(['message' => false], 200);
    }
}
}

//funcion que responde a una ruta para ir al formulario de la compra
public function comprar(){
    //capturo el id de la sesion del usuario
    $id = FacadesAuth::user()->id;
    //capturlo los productos del carrito seleccionados
    $seleccionados = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id=3");
//si hay productos lo redirecciono al formulario de compra si no lo dejo en el carrito y le muestro un mensaje
    if ( $seleccionados) {
        return redirect()->route('purchaseform');
    }else{
        return redirect()->route('shoppingcart')->with('mensaje', 'NO SE AGREGO');
    }
}

//funcion que responde a una ruta que espera un id del carrito para cancelar la seleccion de un producto del carrito previo a comprar validando que el producto del carrito este activo y no inactivo
public function cancelar_seleccion($id){
    $carrito = CartShop::find($id);
    if ($carrito->estados_id == 2) {
        return response()->json(['message' => false], 200);
    }else{
    $carrito->estados_id = 1;
    $carrito->save();
    return response()->json(['message' => true], 200);
    }
}
//funcion que responde a una ruta que espera un id del carrito para la seleccion de un producto del carrito previo a comprar validando que el producto del carrito este activo y no inactivo
public function seleccionar($id){
    $carrito = CartShop::find($id);
    if ($carrito->estados_id == 2) {
        return response()->json(['message' => false], 200);
    }else{
    $carrito->estados_id = 3;
    $carrito->save();
    return response()->json(['message' => true], 200);
    }
}

//funcion que responde a una ruta y calcula los productos del carrito de compras que esten activo y retorna el valor total del carrito del usuario
public function calcular(){
    $id = FacadesAuth::user()->id;
    $carrito = DB::select("SELECT * FROM carrito_compras WHERE id_user = $id AND estados_id<>2");
    $total = 0;
    foreach($carrito as $c){

        $total = $total + ($c->total * $c->cantidad_producto);
    }
    return response()->json(['message' => number_format(intval(round($total)))], 200);
}
}
