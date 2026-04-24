<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:50|unique:categorias,nombre'
            ]);
            $categoria = Categoria::create($request->all());


            return response()->json([
                'message' => 'Categoría creado correctamente',
                'data' => $categoria
            ], 201);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categoria = Categoria::find($id);
            if (!$categoria) {
                return response()->json(['message' => 'Categoría no encontrada'], 404);// Error 404 al no encontrar la categoría
            }
            $request->validate([
                'nombre' => 'required|string|max:50|unique:categorias,nombre'
            ]);
            $categoria->update($request->all());
            return response()->json([
                'message' => 'Categoría actualizada correctamente',
                'data' => $categoria
            ], 200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
