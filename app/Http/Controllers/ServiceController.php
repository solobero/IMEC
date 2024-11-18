<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\SearchInterface;

class ServiceController extends Controller
{
    protected SearchInterface $searchService;

    public function __construct(SearchInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request): View
    {
        $viewData = [];
        $query = Service::query();

        if ($request->has('search')) {
            $keyword = $request->input('search');
            $results = $this->searchService->searchByName($keyword);
            $viewData['services'] = $results['services'];
        } else {
            $viewData['services'] = $query->get();
        }

        if ($request->has('sort') && $request->input('sort') === 'alphabetical') {
            $query->orderBy('name', 'asc');
        }

        if ($request->has('sort') && $request->input('sort') === 'price') {
            $query->orderBy('price', 'asc');
        }

        $viewData['services'] = $query->get();

        return view('service.index')->with('viewData', $viewData);
    }

    public function search(Request $request): View
    {
        $viewData = [];
        $keyword = $request->input('search');
        $query = Service::where('name', 'LIKE', '%' . $keyword . '%');

        if ($request->has('sort') && $request->input('sort') === 'alphabetical') {
            $query->orderBy('name', 'asc');
        }

        if ($request->has('sort') && $request->input('sort') === 'price') {
            $query->orderBy('price', 'asc');
        }

        $viewData['services'] = $query->get();

        return view('service.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [
            'service' => Service::findOrFail($id),
        ];

        return view('service.show')->with('viewData', $viewData);
    }
}