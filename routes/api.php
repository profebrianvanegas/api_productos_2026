<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/saludo', function (Request $request) {
    return response()->json(['mensaje' => 'Hola Mundo']);
});

// --- Rutas Públicas ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/categorias/padre', [CategoriaController::class, 'showParentCategories']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
Route::get('/categorias', [CategoriaController::class, 'index']);

Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::get('/productos', [ProductoController::class, 'index']);

// --- Rutas Protegidas (Requieren Token) ---
Route::middleware('auth:sanctum')->group(function () {
    // Info del usuario actual
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:Cliente')->group(function () {});

    Route::middleware('role:Cliente|Administrador')->group(function () {});

    Route::middleware('role:Administrador')->group(function () {
        Route::post('/categorias', [CategoriaController::class, 'store']);
        Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
        Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

        Route::post('/productos', [ProductoController::class, 'store']);
        Route::put('/productos/{id}', [ProductoController::class, 'update']);
        Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
    });
});
