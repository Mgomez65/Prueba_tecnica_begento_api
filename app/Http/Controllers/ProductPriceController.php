<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    // Obtener los precios de un producto
    public function index($id)
    {
        Product::findOrFail($id);

        $prices = ProductPrice::with('currency')
            ->where('product_id', $id)
            ->get();

        return response()->json($prices, 200);
    }

    // Crear un precio para un producto
    public function store(Request $request, $id)
    {
        Product::findOrFail($id);

        $data = $request->validate([
            'currency_id' => ['required', 'exists:currencies,id'],
            'price' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
        ]);

        $data['product_id'] = $id;

        $productPrice = ProductPrice::create($data);

        return response()->json($productPrice, 201);
    }
}