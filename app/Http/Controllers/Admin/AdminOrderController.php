<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $ordersProductByUser = OrderProduct::with('user')->get()->groupBy('user_id');
        $ordersServiceByUser = OrderService::with('user')->get()->groupBy('user_id');

        $viewData = [];
        $viewData['ordersProductByUser'] = $ordersProductByUser;
        $viewData['ordersServiceByUser'] = $ordersServiceByUser;

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function shipOrder($id): RedirectResponse
    {
        $order = OrderProduct::findOrFail($id);
        $order->status = 'Shipped';
        $order->save();

        return redirect()->route('admin.order.index');
    }

    public function shipService($id): RedirectResponse
    {
        $order = OrderService::findOrFail($id);
        $order->status = 'Complete';
        $order->save();

        return redirect()->route('admin.order.index');
    }
}
