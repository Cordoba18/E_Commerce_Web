<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisteredUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\validateEmail;

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

        $pass = Hash::make($request->password);

        $data = $request->nombre.'%'.$request->apellido.'%'.$request->correo.'%'.$pass.'%'.$request->date;

        $cod = RegisteredUserController::randNumer();

        Mail::to($request->correo)->send(new validateEmail($cod));

        

        return 'siga';
    }


    public static function randNumer() {
        $d=rand(1000,9999);
        return $d;
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