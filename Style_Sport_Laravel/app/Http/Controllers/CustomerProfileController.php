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
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $city = City::where('id', $user->id_ciudad)->first();

        return view('customers.editcustomer',compact('user','city'));
    }

    public function store(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
       
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
            $user->Identificacion = $request->nid;
        }
        if($request->numberphone){
            $user->telefono = $request->numberphone;
        }
        if($request->address){
            $user->direccion = $request->address;
        }

        $user->save();
        return redirect()->route('customerprofile');
    }

    public function destroy(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $user->estados_id = '2';
        $user->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
