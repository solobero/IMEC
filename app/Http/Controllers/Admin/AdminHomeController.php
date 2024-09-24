<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdminHomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
