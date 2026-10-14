<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registro: Asigna rol 'Cliente' por defecto
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // Asignar rol Cliente por defecto
            $user->assignRole('Cliente');
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Usuario registrado exitosamente',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 201);
            
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 400);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            /* throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]); */
            return response()->json(
                ['message' => 'Las credenciales proporcionadas son incorrectas.'],
                401
            );
        }
        // Borrar tokens anteriores (opcional, para sesión única)
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Bienvenido ' . $user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'roles' => $user->getRoleNames(), // Devolver rol para el frontend
        ]);
    }
    /** * Cerrar sesión del usuario autenticado (revocar el token actual). */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
