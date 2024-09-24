<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Service;
use App\Utils\Search;

class ServiceController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['services'] = Service::all();

        return view('service.index')->with('viewData', $viewData);
    }

    public function search(Request $request): View
    {
        $viewData = [];
        $keyword = $request->input('search');
        $viewData["subtitle"] = "Service Search Results";
        $viewData['services'] = Service::where('name', 'LIKE', '%' . $keyword . '%')->get();
        return view('service.index')->with("viewData", $viewData);
    }

    public function show(string $id) : View
    {
        $viewData = [];
        $service = Service::findOrFail($id);
        $viewData['service'] = $service;

        return view('service.show')->with('viewData', $viewData);
    }
}
