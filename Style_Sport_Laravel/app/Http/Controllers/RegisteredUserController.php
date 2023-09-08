<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisteredUserRequest;
//Importo modelos
use App\Models\User;
use App\Models\Code;
//Importo metodo para encriptar contraseña
use Illuminate\Support\Facades\Hash;
//Importo el constructor del envio del correo
use App\Mail\validateEmail;
//Importo mail para enviar informacion del correo
use Illuminate\Support\Facades\Mail;
//Importo el metodo que me permite consultar a la base de datos
use Illuminate\Support\Facades\DB;
//Importo el request para los parametros por POST
use Illuminate\Http\Request as HttpRequest;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    //Este metodo responde a una ruta y muestra el formulario del registro
    public function index()
    {
        return view('users.register');
    }

    //Este metodo responde a un ruta y lo que hace es avanzar con el registro del usuario enviando un correo para validar la existencia del correo valido
    public function store(RegisteredUserRequest $request)
    {
        $user = User::where('correo',$request->correo)->where('estados_id','1')->first();
        //validamos si ya tiene una cuenta registrada con ese correo
        if ($user) {
            //si existe se redirecciona enviandole un mensaje
            return redirect()->route('register')->with('credentials','el correo digitado ya tiene una cuenta existente');
        }
        //Si no existe en caso de que haya un codigo del usuario se elimina ese
        DB::table('codigos')->where('email', '=', $request->correo)->delete();
        //Encriptacion de la contraseña
        $pass = Hash::make($request->password);
        //creacion de union de datos de registros para hacer un split en javascript
        $data = $request->name.'%'.$request->lastname.'%'.$request->correo.'%'.$pass.'%'.$request->date;
        //capturo el correo del request
        $email = $request->correo;
        //generacion del codigo aleatorio
        $cod = RegisteredUserController::randNumer();
        //envio del gmail con codigo, mensaje y asunto
        Mail::to($request->correo)->send(new validateEmail($cod, $request->name, " utiliza el codigo de activacion para finalizar la creaciòn de tu cuenta : ", "CREACION DE CUENTA"));
        //creacion del codigo en la base de datos
        $codificar = new Code();
        $codificar->email = $email;
        $codificar->codigo = $cod;
        $codificar->save();

        //redireccionamiento a la siguiente vista
        return redirect()->route('verification.vista_validar')->with('data', $data);
    }

//metodo que crea el codigo numerico de 4 digitos
    public static function randNumer() {
        $d=rand(1000,9999);
        return $d;
    }

//metodo que responde a una ruta que recibe el correo para eliminar la fila donde el correo sea el capturado en la base de datos
    public function delete_code($correo){

        DB::table('codigos')->where('email', '=', $correo)->delete();
    }
//metodo que responde a una ruta captura la sesion de los datos para previamente capturarlos para finalizar la creacion de la cuenta si todo sale bien
    public function vista_validar(){

        $datos = session('data');
        $mensaje = 'Hemos enviado un codigo para crear su cuenta a ';
        return view('users.validateEmail',compact('datos', 'mensaje'));
}

//metodo que responde a una ruta que recibe todos los datos del usuario por medio del request
public function validation(HttpRequest $request){
//traemos los datos del codigo del usuario
    $user_code = DB::selectOne("SELECT * FROM codigos WHERE email='$request->correo'");
    //capturamos el codigo de los datos del codigo del usuario
    $codigo = $user_code->codigo;
//validamos si el codigo que hay en la base de datos es el mismo que ingreso en el formulario
    if($codigo == $request->codigo){
//si el codigo esta bien creamos el usuario y retornamos un mensaje de aprobacion
        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->contrasena = $request->contrasena;
        $usuario->f_nacimiento = $request->f_nacimiento;
        $usuario->id_rol= 2;
        $usuario->estados_id = 1;
        $usuario->save();
        return response()->json(['message' => true], 200);
    }else {
        //si no retornamos un mensaje de desaprobacion
        return response()->json(['message' => false], 200);
    }





}
}
