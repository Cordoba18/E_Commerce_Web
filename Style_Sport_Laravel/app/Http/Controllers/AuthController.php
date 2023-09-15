<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request){
        $input = $request->only('correo', 'contrasena');

        // Buscar al usuario por su correo electrónico en la base de datos
        $user = User::where('correo', $input['correo'])->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado', // Mensaje para correo incorrecto
            ], 404);
        }

        // Verificar la contraseña
        if (Hash::check($input['contrasena'], $user->contrasena)) {
            // La contraseña coincide
            // Generar el token JWT
            $jwt_token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'token' => $jwt_token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta', // Mensaje para contraseña incorrecta
            ], 401);
        }
    }

    public function logout(){
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(){
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json(['token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo refrescar el token'], 401);
        }
    }
}
