<?php

namespace App\Utils;

use App\Models\Product;
use App\Models\Service;
use App\Interfaces\SearchInterface;

class Search implements SearchInterface
{
    public function searchByName(string $keyword): array {
        
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        $services = Service::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return [
            'products' => $products,
            'services' => $services,
        ];
    }
}
