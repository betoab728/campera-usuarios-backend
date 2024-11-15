<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth; // Asegúrate de importar la clase JWTAuth
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log; // Importa Log


class AuthController extends Controller
{
    // Verificación del Nombre de Usuario
    public function checkUsername(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $user = User::where('name', $request->name)->first();

        if ($user) {
            return response()->json([
                'message' => 'Usuario encontrado',
                'user_id' => $user->id // enviar el ID de usuario si lo necesitas en el frontend
            ], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    // Autenticación Completa con Contraseña usando JWT
    public function login(Request $request)
    {
        //log para verificar que se recibe la información
        Log::info('login: Recibiendo solicitud de login', ['name' => $request->name]);


        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        try {
            // Generación del token JWT
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['message' => 'No se pudo crear el token'], 500);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // Cerrar sesión (Eliminar todos los tokens del usuario)
    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}

?>