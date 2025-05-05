<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //Mostrar todos los productos
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    //Los required al crear productos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0|max:999',
            'image' => 'required|string',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    //Mostar un producto específico
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    //Actualizar un producto en específico
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0|max:999',
            'image' => 'required|string',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    //Borrar un producto específico
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente.'
        ], 200);
    }
}
