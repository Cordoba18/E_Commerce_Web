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

        $data = $request->name.'%'.$request->lastname.'%'.$request->correo.'%'.$pass.'%'.$request->date;
        $email = $request->correo;

        $cod = RegisteredUserController::randNumer();
        Mail::to($request->correo)->send(new validateEmail($cod, $request->name, " utiliza el codigo de activacion para finalizar la creaciòn de tu cuenta : ", "CREACION DE CUENTA"));

        $codificar = new Code();
        $codificar->email = $email;
        $codificar->codigo = $cod;
        $codificar->save();

        return redirect()->route('verification.vista_validar')->with('data', $data);
    }


    public static function randNumer() {
        $d=rand(1000,9999);
        return $d;
    }


    public function delete_code($correo){

        DB::table('codigos')->where('email', '=', $correo)->delete();
    }

    public function vista_validar(){

        $datos = session('data');
        $mensaje = 'Hemos enviado un codigo para crear su cuenta a ';
        return view('users.validateEmail',compact('datos', 'mensaje'));
}


public function validation(HttpRequest $request){

    $user_code = DB::selectOne("SELECT * FROM codigos WHERE email='$request->correo'");
    $codigo = $user_code->codigo;

    if($codigo == $request->codigo){

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
        return response()->json(['message' => false], 200);
    }





}
}
