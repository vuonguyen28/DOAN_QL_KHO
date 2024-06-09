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

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();
        $categories = ProductCategory::all();
    

        

        return view('Admin.Product.index', [
            'products' => $products,
            'suppliers' => $suppliers,
            'warehouses' => $warehouses,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'TENSP' => 'required|string|max:255',
            'MUCCHUYENMAI' => 'required|numeric',
            'DONGIABAN' => 'required|numeric',
            'SLTON' => 'required|numeric',
            'DOVINHTINH' => 'required|string|max:255',
            'MALOAISP' => 'required|string|max:255',
            'MANCC' => 'required|string|max:255',
            'MAKHO' => 'required|string|max:255',
            'HinhSP' => 'nullable|image|max:2048',
        ]);
        $validatedData['MASP'] = random_int(1000000000, 9999999999);

        if ($request->hasFile('HinhSP')) {
            $filename = time() . '_' . Str::random(10) . '.' . $request->file('HinhSP')->getClientOriginalExtension();
            $path = $request->file('HinhSP')->storeAs('product', $filename, 'public');
            $validatedData['HinhSP'] = $path;
        }

        $product = new Product();
        $product->fill($validatedData);
        $product->save();

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'TENSP' => 'required|string|max:255',
            'MUCCHUYENMAI' => 'required|numeric',
            'DONGIABAN' => 'required|numeric',
            'SLTON' => 'required|numeric',
            'DOVINHTINH' => 'required|string|max:255',
            'MALOAISP' => 'required|string|max:255',
            'MANCC' => 'required|string|max:255',
            'MAKHO' => 'required|string|max:255',
            'HinhSP' => 'nullable|image|max:2048',
        ]);

        try {
            $productId = $request->input('MASP');
            $product = Product::findOrFail($productId);

            if ($request->hasFile('HinhSP')) {
                // Xóa ảnh cũ nếu có
                if ($product->HinhSP) {
                    Storage::disk('public')->delete($product->HinhSP);
                }

                // Lưu ảnh mới với tên file ngẫu nhiên theo thời gian
                $filename = time() . '_' . Str::random(10) . '.' . $request->file('HinhSP')->getClientOriginalExtension();
                $path = $request->file('HinhSP')->storeAs('product', $filename, 'public');
                $validatedData['HinhSP'] = $path;
            }

            $product->update($validatedData);

            return redirect()->back()->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $productId = $request->input('MASP');
            $product = Product::findOrFail($productId);
            if ($product->HinhSP) {
                Storage::disk('public')->delete($product->HinhSP);
            }
            $product->delete();

            return redirect()->back()->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm.');
        }
    }
}
