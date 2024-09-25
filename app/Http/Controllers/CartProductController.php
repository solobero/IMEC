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
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }
        $viewData = [];
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;

        return view('cart.product.index')->with('viewData', $viewData);
    }

    public function add(Request $request, $id): RedirectResponse
    {
        $products = $request->session()->get('products');
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
        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $user = Auth::user(); // Obtiene al usuario autenticado
            $userId = $user->getId();
            $orderProduct = new OrderProduct;
            $orderProduct->setUserId($userId);
            $orderProduct->setTotal(0);
            $orderProduct->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));

            // Calcular el total de los productos antes de procesar la orden
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $total += ($product->getPrice() * $quantity);
            }

            // Verificar si el usuario tiene suficiente balance
            if ($user->getBalance() < $total) {
                return redirect()->route('cart.product.index')->with('error', 'Insufficient balance to complete the purchase.');
            }

            // Proceder con la compra si tiene balance suficiente
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $itemProduct = new ItemProduct;
                $itemProduct->setQuantity($quantity);
                $itemProduct->setPrice($product->getPrice());
                $itemProduct->setProductId($product->getId());
                $itemProduct->setOrderProductId($orderProduct->getId());
                $itemProduct->save();
            }

            // Actualizar el total de la orden y guardar
            $orderProduct->setTotal($total);
            $orderProduct->save();

            // Restar el total del balance del usuario
            $newBalance = $user->getBalance() - $total;
            $user->setBalance($newBalance);
            $user->save();

            // Vaciar el carrito de la sesión
            $request->session()->forget('products');

            // Preparar los datos para la vista
            $viewData = [];
            $viewData['orderProduct'] = $orderProduct;

            return view('cart.product.purchase')->with('viewData', $viewData);
        } else {
            return redirect()->route('cart.product.index');
        }
    }
}
