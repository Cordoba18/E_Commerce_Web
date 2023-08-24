<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Code;
use Illuminate\Support\Facades\Mail;
use App\Mail\validateEmail;
use Illuminate\Support\Facades\Hash;

class RecoveryPasswordController extends Controller
{
    public function index()
    {
        return view('users.recoverPassword');
    }

    public function validation_email(HttpRequest $request){

        $email = $request->email;
        $verificacion = DB::selectOne("SELECT * FROM Users WHERE correo='$email'");
        $nombre =  $verificacion->nombre;
        if ($verificacion) {
            // $cod = RecoveryPasswordController::randNumer();
            // DB::table('codigos')->where('email', '=', $email)->delete();
            // Mail::to($email)->send(new validateEmail($cod, $nombre));
            // $codificar = new Code();
            // $codificar->email = $email;
            // $codificar->codigo = $cod;
            // $codificar->save();

            $mensaje = 'Hemos enviado un codigo para recuperar tu contraseña a ';
            return view('users.validateEmailpassword',compact('email', 'mensaje'));
        }else {
            
        }
    }

    public function validation_code(HttpRequest $request){

        $user_code = DB::selectOne("SELECT * FROM codigos WHERE email='$request->correo'");
        $codigo = $user_code->codigo;    
        if($codigo == $request->codigo){
            return response()->json(['message' => true], 200);
        }else {
            return response()->json(['message' => false], 200);
        }
    }    
    public static function randNumer() {
        $d=rand(1000,9999);
        return $d;
    }

    public function change_password(HttpRequest $request){
        $pass = Hash::make($request->password);
        $user = DB::selectOne("SELECT * FROM Users WHERE correo='$request->correo' AND estado_id=1");
        if ($request->password == $request->password_confirmation) {
            if (Hash::check($request->password, $user->contrasena)) {
                dd(" coincide");
            }else {
                dd("No coincide la contraseña");
            }
        } else {
            dd("No coincide las contraseñas");
        }
        

    }
}
