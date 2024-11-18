<?php

namespace App\Http\Controllers;

use App\Models\ItemProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartProductController extends Controller
{
    public function index(Request $request): View
    {

        $user = Auth::user();
        $balance = $user->getBalance();

        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get('products');

        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }

        $viewData = [
            'total' => $total,
            'products' => $productsInCart,
            'balance' => $balance,
        ];

        return view('cart.product.index')->with('viewData', $viewData);
    }

    public function add(Request $request, int $id): RedirectResponse
    {
        $products = $request->session()->get('products', []);
        $products[$id] = $request->input('quantity', 1);
        $request->session()->put('products', $products);

        return redirect()->route('cart.product.index');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('products');

        return back();
    }

    public function purchaseProduct(Request $request): View|RedirectResponse
    {
        $productsInSession = $request->session()->get('products');

        if (!$productsInSession) {
            return redirect()->route('cart.product.index');
        }

        $user = Auth::user(); 
        $total = 0;
        $productsInCart = Product::findMany(array_keys($productsInSession));

        foreach ($productsInCart as $product) {
            $quantity = $productsInSession[$product->getId()];
            $total += $product->getPrice() * $quantity;
        }

        if ($user->getBalance() < $total) {
            return redirect()->route('cart.product.index')
                ->with('error', 'Saldo insuficiente para completar la compra.');
        }

        $userId = $user->getId();
        $orderProduct = new OrderProduct();
        $orderProduct->setUserId($userId);
        $orderProduct->setTotal($total);
        $orderProduct->save();

        foreach ($productsInCart as $product) {
            $quantity = $productsInSession[$product->getId()];
            $itemProduct = new ItemProduct();
            $itemProduct->setQuantity($quantity);
            $itemProduct->setPrice($product->getPrice());
            $itemProduct->setProductId($product->getId());
            $itemProduct->setOrderProductId($orderProduct->getId());
            $itemProduct->save();
        }

        $newBalance = $user->getBalance() - $total;
        $user->setBalance($newBalance);
        $user->save();

        $request->session()->forget('products');

        $viewData = [
            'orderProduct' => $orderProduct,
        ];

        return view('cart.product.purchase')->with('viewData', $viewData);
    }
}