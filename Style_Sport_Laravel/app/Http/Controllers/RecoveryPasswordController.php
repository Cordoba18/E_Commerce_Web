<?php

namespace App\Http\Controllers;

//importo request para los parametros por POST
use Illuminate\Http\Request as HttpRequest;
//importo metodo que me permite consultar a la base de datos
use Illuminate\Support\Facades\DB;
//Importo modelos
use App\Models\Code;
//importo validateEmail para construid el correo
use App\Mail\validateEmail;
//Importo mail para enviar informacion del correo
use Illuminate\Support\Facades\Mail;
//Importo Hash como metodo para encriptar contraseña
use Illuminate\Support\Facades\Hash;

class RecoveryPasswordController extends Controller
{
    //Este metodo responde a una ruta y muestra la vista para obtener el correo y enviar el codigo
    public function index()
    {
        return view('users.recoverPassword');
    }

    //Este codigo recibe el correo para enviar el codigo al correo del usuario y previamente enviarlo a la base de datos
    //Si el usuario no existe lo retorna la a la vista mostrandole un mensaje de que no existe en el sistema

    public function validation_email(HttpRequest $request){

        $email = $request->email;
        $verificacion = DB::selectOne("SELECT * FROM Users WHERE correo='$email' AND estados_id=1");
        if ($verificacion) {
            $nombre =  $verificacion->nombre;
            $cod = RecoveryPasswordController::randNumer();
            DB::table('codigos')->where('email', '=', $email)->delete();
            Mail::to($email)->send(new validateEmail($cod, $nombre, " utiliza el codigo para finalizar el cambio de contraseña : ", "CAMBIO DE CONTRASEÑA"));
             $codificar = new Code();
            $codificar->email = $email;
            $codificar->codigo = $cod;
            $codificar->save();

            $mensaje = 'Hemos enviado un codigo para recuperar tu contraseña a ';
            return view('users.validateEmailpassword',compact('email', 'mensaje'));
        }else {
            return redirect()->route('recoverpassword')->with('recover_false', true);
        }
    }

    // Este metodo responde a una ruta el cual valida si  el codigo ingresado por el usuario existe en la base de datos.
    public function validation_code(HttpRequest $request){

        $user_code = DB::selectOne("SELECT * FROM codigos WHERE email='$request->correo'");
        $codigo = $user_code->codigo;
        if($codigo == $request->codigo){
            return response()->json(['message' => true], 200);
        }else {
            return response()->json(['message' => false], 200);
        }
    }
    //Este metodo genera un codigo numerico de 4 digitos de forma aleatoria
    public static function randNumer() {
        $d=rand(1000,9999);
        return $d;
    }

//Este metodo responde a una ruta la cual elimina el codigo del usuario
    public function delete_code($correo){

        DB::table('codigos')->where('email', '=', $correo)->delete();
    }

//Este metodo responde a una ruta la cual cambia la contraseña del usuario
    public function change_password(HttpRequest $request){

        $pass = Hash::make($request->password);
        if (DB::update("UPDATE `Users` SET `contrasena`='$pass' WHERE correo='$request->email'")) {
            return response()->json(['message' => true], 200);
        }else{
            return response()->json(['message' => false], 200);
        }
    }
}
