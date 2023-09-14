<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerProfileController extends Controller
{
    public function __construct()
    {
        // verificamos si esta autenticado o no
        $this->middleware('auth');
    }

    public function index()
    {
        // buscamos al usuario y buscamos la ciudad a la que pertenece
        $user = User::where('id', Auth::user()->id)->first();
        $city = City::where('id', $user->id_ciudad)->first();

        // retornamos a la pagina de usuario, mandando el usuario y la ciudad
        return view('customers.editcustomer',compact('user','city'));
    }

    public function store(Request $request){
        // buscamos al usuario
        $user = User::where('id', Auth::user()->id)->first();

        //utilizamos esto para editar toda la informacion del usuario
        if ($request->name && $request->lastname) {
            $user->nombre = $request->name.' '.$request->lastname;
        }
        if ($request->pass && $request->passnow) {
            if (!Hash::check($request->pass, $user->contrasena)) {
                return redirect()->route('customerprofile')->with('error', 'la contraseña actual es incorrecta');
            }
            $user->contrasena = Hash::make($request->passnow);
        }
        if ($request->nid) {
            $user->Identificacion = 'CC';
            $user->N_Identificacion = $request->nid;
        }
        if($request->numberphone){
            $user->telefono = $request->numberphone;
        }
        if($request->address){
            $user->direccion = $request->address;
        }
        
        // guardamos el usuario y lo redirrecionaron a la pagina de usuario
        $user->save();

        return redirect()->route('customerprofile');
    }

    public function destroy(Request $request){

        // esto lo hacemos para borrar la cuenta del usuario
        $user = User::where('id', Auth::user()->id)->first();
        $user->estados_id = '2';
        $user->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redireccionamos al home
        return redirect()->route('home');
    }
}
