<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\OrderService;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function orderProduct()
    {
        $viewData = [];
        $viewData["title"] = "My Orders - Online Store";
        $viewData["subtitle"] = "My Orders";
        $viewData["orderProduct"] = OrderProduct::with(['itemsProduct'])->where('user_id', Auth::user()->getId())->get();
        //$viewData["orderProduct"] = OrderProduct::where('user_id', Auth::user()->getId())->get();
        return view('myaccount.order_product')->with("viewData", $viewData);
    }

    public function orderService()
    {
        $viewData = [];
        $viewData["title"] = "My Orders - Online Store";
        $viewData["subtitle"] = "My Orders";
        $viewData["orderService"] = OrderService::with(['itemsService'])->where('user_id', Auth::user()->getId())->get();
        return view('myaccount.order_service')->with("viewData", $viewData);
    }
}
