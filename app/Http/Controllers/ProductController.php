<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Product;
use App\Utils\Search;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    public function search(Request $request): View
    {
        $viewData = [];
        $keyword = $request->input('search'); 
        $viewData["subtitle"] = "Product Search Results";
        $viewData['products'] = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return view('product.index')->with("viewData", $viewData);
    }
}
