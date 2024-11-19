<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{

    public function index(): JsonResponse
    {

        $products = Product::all();

        $productsData = $products->map(function ($product) {
            return [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
                'warranty' => $product->getWarranty(),
                'image_url' => url('storage/' . $product->getImage()), 
            ];
        });

        return response()->json(['data' => $productsData], 200);
    }

    public function show(string $id): JsonResponse
    {

        $product = Product::findOrFail($id);

        return response()->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'warranty' => $product->getWarranty(),
            'image_url' => url('storage/' . $product->getImage()),  
        ], 200);
    }
}