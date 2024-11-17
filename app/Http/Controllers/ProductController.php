<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\SearchInterface;

class ProductController extends Controller
{
    protected $searchService;

    public function __construct(SearchInterface $searchService)
    {
        $this->searchService = $searchService;
    }
    
    public function index(Request $request): View
    {
        $viewData = [];
        $query = Product::query();

        if ($request->has('search')) {
            $keyword = $request->input('search');
            $results = $this->searchService->searchByName($keyword);
            $viewData['products'] = $results['products'];
        }

        else {
            $viewData['products'] = $query->get();
        }

        if ($request->has('sort') && $request->input('sort') === 'alphabetical') {
            $query->orderBy('name', 'asc');
        }

        if ($request->has('sort') && $request->input('sort') === 'price') {
            $query->orderBy('price', 'asc');
        }

        $viewData['products'] = $query->get();

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
        $query = Product::where('name', 'LIKE', '%'.$keyword.'%');

        if ($request->has('sort') && $request->input('sort') === 'alphabetical') {
            $query->orderBy('name', 'asc');
        }

        if ($request->has('sort') && $request->input('sort') === 'price') {
            $query->orderBy('price', 'asc');
        }

        $viewData['products'] = $query->get();

        return view('product.index')->with('viewData', $viewData);
    }

    public function bestSellers(): View
    {
        $viewData = [];
        $viewData['products'] = Product::inRandomOrder()->take(2)->get();

        return view('product.best_sellers')->with('viewData', $viewData);
    }
}
