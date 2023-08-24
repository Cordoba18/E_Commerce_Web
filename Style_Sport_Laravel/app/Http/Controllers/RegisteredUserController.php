<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteredUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\validateEmail;
use App\Models\Code;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as HttpRequest;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('users.register');
    }

    public function store(RegisteredUserRequest $request)
    {
        $user = User::where('correo',$request->correo)->where('estados_id','1')->first();
        if ($user) {
            return redirect()->route('register')->with('credentials','el correo digitado ya tiene una cuenta existente');
        }
        DB::table('codigos')->where('email', '=', $request->correo)->delete();
        $pass = Hash::make($request->password);

        $data = $request->name.'%'.$request->lastname.'%'.$request->correo.'%'.$pass.'%'.$request->date;
        $email = $request->correo;

        $cod = RegisteredUserController::randNumer();

        Mail::to($request->correo)->send(new validateEmail($cod, $request->name));

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
// $user = User::create([
//     'nombre' => $request->name.' '.$request->lastname,
//     'correo' => $request->correo,
//     'contrasena' => Hash::make($request->password),
//     'f_nacimiento' => $request->date,
//     'id_rol' => 2,
//     'estados_id' => 1,
// ]);
