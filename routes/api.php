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

// --- Rutas Protegidas (Requieren Token) ---
Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('role:Cliente')->group(function () {
        Route::get('/categorias', [CategoriaController::class, 'index']);
    });

    Route::middleware('role:Cliente|Administrador')->group(function () {
        
    });

    Route::middleware('role:Administrador')->group(function () {
        
    });


    Route::get('/categorias/padre', [CategoriaController::class, 'showParentCategories']);

    Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
    Route::post('/categorias', [CategoriaController::class, 'store']);
    Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

    Route::get('/productos', [ProductoController::class, 'index']);
    Route::get('/productos/{id}', [ProductoController::class, 'show']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::put('/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
});
