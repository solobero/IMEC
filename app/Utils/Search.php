<?php

namespace App\Utils;

use App\Models\Product;
use App\Models\Service;

class Search
{
    public static function searchByName(string $keyword)
    {
        // Buscar productos
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        // Buscar servicios
        $services = Service::where('name', 'LIKE', '%' . $keyword . '%')->get();

        // Devolver los resultados combinados
        return [
            'products' => $products,
            'services' => $services
        ];
    }
}