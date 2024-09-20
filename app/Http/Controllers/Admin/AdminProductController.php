<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData["products"] = Product::all();

        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::validate($request);
        $newProduct = new Product();
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setImage("game.png");
        $newProduct->setPrice($request->input('price'));
        $newProduct->setWarranty($request->input('warranty'));
        $newProduct->save();

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put($imageName, file_get_contents($request->file('image')->getRealPath()));
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return back();
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData["product"] = Product::findOrFail($id);
        return view('admin.product.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        Product::validate($request);
        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setWarranty($request->input('warranty'));
        $product->save();

        if ($request->hasFile('image')) {
            $imageName = $product->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put
            ($imageName,
            file_get_contents($request->file('image')->getRealPath())
        );
            $product->setImage($imageName);
        }

        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function delete($id): RedirectResponse
    {
        Product::destroy($id);
        return back();
    }
}
