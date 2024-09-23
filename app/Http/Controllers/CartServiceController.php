<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\OrderService;
use App\Models\ItemService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartServiceController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $servicesInCart = [];
        $servicesInSession = $request->session()->get("services");
        if ($servicesInSession) {
            $servicesInCart = Service::findMany(array_keys($servicesInSession));
            $total = Service::sumPricesByQuantities($servicesInCart, $servicesInSession);
        }
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["services"] = $servicesInCart;
        return view('cart.service.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id): RedirectResponse

    {
        $services = $request->session()->get("services");
        $services[$id] = $request->input('quantity');
        $request->session()->put('services', $services);
        return redirect()->route('cart.service.index');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('services');
        return back();
    }

    public function purchaseService(Request $request)
    {
        $servicesInSession = $request->session()->get("services");
        if ($servicesInSession) {
            $userId = Auth::user()->getId();
            $orderService = new OrderService();
            $orderService->setUserId($userId);
            $orderService->setTotal(0);
            $orderService->save();
            $total = 0;
            $servicesInCart = Service::findMany(array_keys($servicesInSession));
            foreach ($servicesInCart as $service) {
                $quantity = $servicesInSession[$service->getId()];
                $itemService = new ItemService();
                $itemService->setQuantity($quantity);
                $itemService->setPrice($service->getPrice());
                $itemService->setServiceId($service->getId());
                $itemService->setOrderServiceId($orderService->getId());
                $itemService->save();
                $total = $total + ($service->getPrice() * $quantity);
            }
            $orderService->setTotal($total);
            $orderService->save();
            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);

            Auth::user()->save();
            $request->session()->forget('services');
            $viewData = [];
            $viewData["title"] = "Purchase - Online Store";
            $viewData["subtitle"] = "Purchase Status";
            $viewData["orderService"] = $orderService;
            return view('cart.service.purchase')->with("viewData", $viewData);
        } else {
            return redirect()->route('cart.service.index');
        }
    } 
}
