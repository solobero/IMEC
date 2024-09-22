<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ItemProduct;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartProductController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }
        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] = "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["products"] = $productsInCart;
        return view('cart.product.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id): RedirectResponse

    {
        $products = $request->session()->get("products");
        $products[$id] = $request->input('quantity');
        $request->session()->put('products', $products);
        return redirect()->route('cart.product.index');
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('products');
        return back();
    }

    public function purchaseProduct(Request $request)
    {
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $userId = Auth::user()->getId();
            $orderProduct = new OrderProduct();
            $orderProduct->setUserId($userId);
            $orderProduct->setTotal(0);
            $orderProduct->save();
            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $itemProduct = new ItemProduct();
                $itemProduct->setQuantity($quantity);
                $itemProduct->setPrice($product->getPrice());
                $itemProduct->setProductId($product->getId());
                $itemProduct->setOrderProductId($orderProduct->getId());
                $itemProduct->save();
                $total = $total + ($product->getPrice() * $quantity);
            }
            $orderProduct->setTotal($total);
            $orderProduct->save();
            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);

            Auth::user()->save();
            $request->session()->forget('products');
            $viewData = [];
            $viewData["title"] = "Purchase - Online Store";
            $viewData["subtitle"] = "Purchase Status";
            $viewData["orderProduct"] = $orderProduct;
            return view('cart.product.purchase')->with("viewData", $viewData);
        } else {
            return redirect()->route('cart.product.index');
        }
    } 
}
