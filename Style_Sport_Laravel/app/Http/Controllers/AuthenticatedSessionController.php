<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticatedSessionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        // aqui lo que se hace es validar que la persona que entre al login es un usuario no autentificado,
        // execto si se dirige a la funcion destroy
        $this->middleware('guest',['except' => ['destroy']]);
    }

    public function index()
    {
        // retornamos a la vista de login
        return view('users.login');
    }

    public function store(AuthenticatedSessionRequest $request)
    {
        // busco un usuario que coincida con el correo
        $user = User::where('correo', $request->email)->where('estados_id', '1')->first();

        // valido que el usuario exista
        if (!$user) {

            // si no existe se retorna a la vista login
            return redirect()->route('login')->with('credentials', 'credenciales incorrectas');
        }

        //validamos que la password sea igual
        if (!Hash::check($request->password, $user->contrasena)) {

            // si no coincide se redirecciona a la vista login
            return redirect()->route('login')->with('credentials', 'credenciales incorrectas');
        }

        // autenticamos el usuario
        Auth::login($user);

        $request->session()->regenerate();

        // redireccionamoa al home
        return redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        // aqui lo que hacemos es hacer el proceso de logout al usuario 
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // aqui volvemos a redireccionar al home
        return redirect()->route('home');
    }

    
}
