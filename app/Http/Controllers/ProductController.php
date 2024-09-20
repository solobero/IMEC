<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{

    public function index(): View
    {
        $viewData = [];
        $viewData["subtitle"] =  "List Of Products";
        $viewData["products"] = Product::all();
        return view('product.index')->with("viewData", $viewData);
    }

    public function show(string $id) : View
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["subtitle"] =  $product["name"]." - Product information";
        $viewData["product"] = $product;
        return view('product.show')->with("viewData", $viewData);
    }
}
