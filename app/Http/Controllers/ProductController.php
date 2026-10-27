<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        $products = Product::with('currency')->get();

        return response()->json([
            'data' => $products
        ], 200);
    }

    // Crear un producto
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'data' => $product->load('currency')
        ], 201);
    }

    // Obtener un producto por ID
    public function show($id)
    {
        $product = Product::with('currency', 'prices.currency')
            ->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'data' => $product
        ], 200);
    }

    // Actualizar un producto
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $product->update($request->validated());

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'data' => $product->fresh()->load('currency')
        ], 200);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}
