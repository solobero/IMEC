<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData["subtitle"] =  "List Of Services";
        $viewData["services"] = Service::all();
        return view('service.index')->with("viewData", $viewData);
    }

    public function show(string $id) : View
    {
        $viewData = [];
        $service = Service::findOrFail($id);
        $viewData["subtitle"] =  $service["name"]." - Service Information";
        $viewData["service"] = $service;
        return view('service.show')->with("viewData", $viewData);
    }
}