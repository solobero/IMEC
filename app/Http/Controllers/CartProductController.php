<?php

namespace App\Http\Controllers;

use App\Models\ItemProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Utils\PDFReportGenerator;
use App\Utils\TXTReportGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CartProductController extends Controller
{
    protected PDFReportGenerator $pdfReportGenerator;

    protected TXTReportGenerator $txtReportGenerator;

    public function __construct(PDFReportGenerator $pdfReportGenerator, TXTReportGenerator $txtReportGenerator)
    {
        $this->pdfReportGenerator = $pdfReportGenerator;
        $this->txtReportGenerator = $txtReportGenerator;
    }

    public function index(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

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

    public function downloadPdfReport(int $id): BinaryFileResponse|RedirectResponse
    {
        $orderProduct = OrderProduct::find($id);
        if ($orderProduct) {
            $filePath = storage_path('reports/pdf/order_'.$id.'.pdf');
            if (file_exists($filePath)) {

                return response()->download($filePath);
            }
        }

        return redirect()->back()->with('error', __('messages.errorPDF'));
    }

    public function downloadTxtReport(int $id): BinaryFileResponse|RedirectResponse
    {
        $orderProduct = OrderProduct::find($id);
        if ($orderProduct) {
            $filePath = storage_path('reports/txt/order_'.$id.'.txt');
            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }

        return redirect()->back()->with('error', __('messages.errorTXT'));
    }

    public function purchaseProduct(Request $request): View|RedirectResponse
    {
        $productsInSession = $request->session()->get('products');

        if (! $productsInSession) {
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
                ->with('error', __('messages.insufficientBalance'));
        }

        $userId = $user->getId();
        $orderProduct = new OrderProduct;
        $orderProduct->setUserId($userId);
        $orderProduct->setTotal($total);
        $orderProduct->save();

        foreach ($productsInCart as $product) {
            $quantity = $productsInSession[$product->getId()];
            $itemProduct = new ItemProduct;
            $itemProduct->setQuantity($quantity);
            $itemProduct->setPrice($product->getPrice());
            $itemProduct->setProductId($product->getId());
            $itemProduct->setOrderProductId($orderProduct->getId());
            $itemProduct->save();
        }

        $newBalance = $user->getBalance() - $total;
        $user->setBalance($newBalance);
        $user->save();

        $this->pdfReportGenerator->generateReport($orderProduct);
        $this->txtReportGenerator->generateReport($orderProduct);

        $request->session()->forget('products');

        $viewData = [
            'orderProduct' => $orderProduct,
        ];

        return view('cart.product.purchase')->with('viewData', $viewData);
    }
}
