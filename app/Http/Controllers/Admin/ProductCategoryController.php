<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;


class ProductCategoryController extends Controller
{
    public function index()
    {
        $ProductCategory = ProductCategory::all();
        return view('Admin.ProductCategory.index', ['ProductCategory' => $ProductCategory]);
    }

    public function store(Request $request)
    {
        $categoryName = $request->input('TENLOAISP');

        $firstLetter = Str::substr($categoryName, 0, 1);

        $randomNumberPart = Str::random(9, '0123456789');

        $randomCode = strtoupper($firstLetter . $randomNumberPart);

        $validatedData = $request->validate([
            'TENLOAISP' => 'required|string|max:255',
        ]);

        $validatedData['MALOAISP'] = $randomCode;

        $productCategory = new ProductCategory();
        $productCategory->fill($validatedData);

        $productCategory->save();
        return redirect()->back()->with('success', 'Loại sản phẩm đã được thêm thành công.');
    }

    public function update(Request $request)
    {
        try {
            $categoryId = $request->input('MALOAISP');
            $categoryName = $request->input('TENLOAISP');
            $productCategory = ProductCategory::findOrFail($categoryId);
            $productCategory->TENLOAISP =  $categoryName;
            $productCategory->save();

            return redirect()->back()->with('success', 'Loại sản phẩm đã được update thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi update loại sản phẩm.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $categoryId = $request->input('MALOAISP');
            $productCategory = ProductCategory::findOrFail($categoryId);
            $productCategory->delete();

            return redirect()->back()->with('success', 'Loại sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa loại sản phẩm.');
        }
    }
}
