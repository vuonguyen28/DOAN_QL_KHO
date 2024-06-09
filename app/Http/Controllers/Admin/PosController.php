<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('MALOAISP');
        
        $productsQuery = Product::query();
    
        if ($categoryId) {
            $productsQuery->where('MALOAISP', $categoryId);
        }
    
        if ($search) {
            $productsQuery->where('TENSP', 'like', '%' . $search . '%');
        }
    
        $products = $productsQuery->get();
    
        $categories = ProductCategory::all();
    
        $cart = $request->session()->get('cart');
    
        $totalPrice = 0;
        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['quantity'] * $item['price'];
            }
        }
    
        return view('Admin.pos.index', [
            'products' => $products,
            'categories' => $categories,
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);
    }
    
 
    public function addToCart(Request $request)
    {
        $productId = $request->input('MASP');
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
        }

        $cart = $request->session()->get('cart');

        if (!$cart) {
            $cart = [
                $productId => [
                    'name' => $product->TENSP,
                    'quantity' => 1,
                    'price' => $product->DONGIABAN
                ]
            ];
        } else {
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($cart[$productId])) {
                // Nếu đã có, tăng số lượng lên 1
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'name' => $product->TENSP,
                    'quantity' => 1,
                    'price' => $product->DONGIABAN
                ];
            }
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
}
