<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticatedSessionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['except' => ['destroy']]);
    }

    public function index()
    {
        return view('users.login');
    }

    public function store(AuthenticatedSessionRequest $request)
    {
        $user = User::where('correo', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('credentials', 'credenciales incorrectas');
        }
        if (!Hash::check($request->password, $user->contrasena)) {
            return redirect()->route('login')->with('credentials', 'credenciales incorrectas');
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
