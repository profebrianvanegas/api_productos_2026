<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
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
                'categoria_id' => 'required|exists:categorias,id',
                'nombre' => 'required|string|max:150',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0', // Restricción RF-GP-006
                'url_imagen' => 'nullable|url|max:255',
                'estado' => 'required|in:Activo,Inactivo' // Validación ENUM
            ]);

            $producto = new Producto;

            $producto->categoria_id = $request->categoria_id;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->url_imagen = $request->url_imagen;
            $producto->estado = $request->estado;

            $producto->save();


            return response()->json([
                'message' => 'Producto creado correctamente',
                'data' => $producto
            ], 201);
        } catch (ValidationException $e) {
            // Manejar la excepción de validación
            return response()->json([
                'message' => 'Datos enviados no válidos',
                //'errors' => $e->validator->errors()
            ], 422); // Código de estado 422 para errores de validación

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el producto',
                //'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto, $id)
    {
        $producto = Producto::find($id)->with('categoria')->get();

        if (!$producto) {
            return response()->json("No se encontro la producto", 404);
        }

        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto, $id)
    {
        try {
            $request->validate([
                'categoria_id' => 'required|exists:categorias,id',
                'nombre' => 'required|string|max:150',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0', // Restricción RF-GP-006
                'url_imagen' => 'nullable|url|max:255',
                'estado' => 'required|in:Activo,Inactivo' // Validación ENUM
            ]);

            $producto = Producto::find($id);

            if (!$producto) {
                return response()->json("No se encontro el producto", 404);
            }

            $producto->categoria_id = $request->categoria_id;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->stock = $request->stock;
            $producto->url_imagen = $request->url_imagen;
            $producto->estado = $request->estado;

            $producto->save();


            return response()->json([
                'message' => 'Producto modificado correctamente',
                'data' => $producto
            ], 201);
        } catch (ValidationException $e) {
            // Manejar la excepción de validación
            return response()->json([
                'message' => 'Datos enviados no válidos',
                //'errors' => $e->validator->errors()
            ], 422); // Código de estado 422 para errores de validación

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al modificar el producto',
                //'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto, $id)
    {
        try {
            $producto = Producto::find($id);

            if (!$producto) {
                return response()->json("No se encontro el producto", 404);
            }

            $producto->delete();

            return response()->json([
                'message' => 'Producto eliminada correctamente'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el producto',
                //'error' => $e->getMessage()
            ], 500); // Puedes cambiar el código de estado según sea necesario
        }
    }
}
