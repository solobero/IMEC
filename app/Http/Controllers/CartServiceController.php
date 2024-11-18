<?php

namespace App\Http\Controllers;

use App\Models\ItemService;
use App\Models\OrderService;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartServiceController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $servicesInCart = [];
        $servicesInSession = $request->session()->get('services');

        if ($servicesInSession) {
            $servicesInCart = Service::findMany(array_keys($servicesInSession));
            $total = Service::sumPricesByQuantities($servicesInCart, $servicesInSession);
        }

        $viewData = [
            'total' => $total,
            'services' => $servicesInCart,
        ];

        return view('cart.service.index')->with('viewData', $viewData);
    }

    public function add(Request $request, int $id): RedirectResponse
    {
        $services = $request->session()->get('services', []);
        $services[$id] = $request->input('quantity', 1);
        $request->session()->put('services', $services);

        return redirect()->route('cart.service.index');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('services');

        return back();
    }

    public function purchaseService(Request $request): View|RedirectResponse
    {
        $servicesInSession = $request->session()->get('services');

        if (!$servicesInSession) {
            return redirect()->route('cart.service.index');
        }

        $user = Auth::user();
        $userId = $user->getId();
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
            $total += $service->getPrice() * $quantity;
        }

        $orderService->setTotal($total);
        $orderService->save();

        $newBalance = $user->getBalance() - $total;
        $user->setBalance($newBalance);
        $user->save();

        $request->session()->forget('services');

        $viewData = [
            'orderService' => $orderService,
        ];

        return view('cart.service.purchase')->with('viewData', $viewData);
    }
}