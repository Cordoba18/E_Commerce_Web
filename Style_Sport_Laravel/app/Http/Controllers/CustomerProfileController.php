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
        return view('customers.editcustomer', compact('user', 'city'));
    }

    public function store(Request $request)
    {
        // buscamos al usuario
        $user = User::where('id', Auth::user()->id)->first();


        //utilizamos esto para editar toda la informacion del usuario
        if ($request->name && $request->lastname) {
            if (!empty($request->name) && !empty($request->lastname)) {
                $user->nombre = $request->name . ' ' . $request->lastname;
            } else {
                return redirect()->route('customerprofile')->with('error', 'El nombre o al apellido estan vacios');
            }
        }
        if ($request->pass && $request->passnow) {
            if (!empty($request->pass) && strlen($request->pass) >= 8) {
                if (!preg_match("/[A-Z]/", $request->pass) && !preg_match("/[a-z]/", $request->pass) && !preg_match("/[0-9]/", $request->pass) && !preg_match("/[\W_]/", $request->pass)) {
                    return redirect()->route('customerprofile')->with('error', 'Contraseña debe tener una mayuscula, una minuscula, un numero y un caracter especial');
                }
                if (!Hash::check($request->pass, $user->contrasena)) {
                    return redirect()->route('customerprofile')->with('error', 'la contraseña actual es incorrecta');
                }
                $user->contrasena = Hash::make($request->passnow);
            } else {
                return redirect()->route('customerprofile')->with('error', 'Contraseña vacia o menor a 8 caracteres');
            }
        }
        if ($request->nid) {
            if (!empty($request->nid) && preg_match('/[0-9]/', $request->nid)) {
                if (!strlen($request->nid) >= 8 && !strlen($request->nid) <= 11) {
                    return redirect()->route('customerprofile')->with('error', 'El numero de telefono debe contener 10 digitos');
                }
                $user->Identificacion = 'CC';
                $user->N_Identificacion = $request->nid;
            } else {
                return redirect()->route('customerprofile')->with('error', 'El numero de identificacion esta vacio o contiene letras');
            }
        }
        if ($request->numberphone) {
            if (!empty($request->numberphone) && preg_match('/[0-9]/', $request->numberphone)) {
                if (!strlen($request->numberphone) >= 10 && !strlen($request->numberphone) <= 10) {
                    return redirect()->route('customerprofile')->with('error', 'El numero de telefono debe contener 10 digitos');
                }
                $user->telefono = $request->numberphone;
            } else {
                return redirect()->route('customerprofile')->with('error', 'El numero de telefono esta vacio o contiene letras');
            }
        }
        if ($request->address) {
            if (!empty($request->address)) {
                $user->direccion = $request->address;
            } else {
                return redirect()->route('customerprofile')->with('error', 'La direccion esta vacia');
            }
        }

        // guardamos el usuario y lo redirrecionaron a la pagina de usuario
        $user->save();

        return redirect()->route('customerprofile');
    }

    public function destroy(Request $request)
    {

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
