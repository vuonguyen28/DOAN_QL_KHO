<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier; 
use Illuminate\Support\Str;

class SupplierControllerController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all(); 
        return view('Admin.Supplier.index', ['suppliers' => $suppliers]); 
    }

    public function store(Request $request)
    {
        $supplierName = $request->input('TENNCC'); 

        $firstLetter = Str::substr($supplierName, 0, 1);
        $randomNumberPart = Str::random(9, '0123456789');
        $randomCode = strtoupper($firstLetter . $randomNumberPart);

        $validatedData = $request->validate([
            'TENNCC' => 'required|string|max:255', 
        ]);

        $validatedData['MANCC'] = $randomCode; 

        $supplier = new Supplier();
        $supplier->fill($validatedData);

        $supplier->save();
        return redirect()->back()->with('success', 'Nhà cung cấp đã được thêm thành công.'); 
    }

    public function update(Request $request)
    {
        try {
            $supplierId = $request->input('MANCC'); 
            $supplierName = $request->input('TENNCC'); 
            $supplier = Supplier::findOrFail($supplierId);
            $supplier->TENNCC =  $supplierName; 
            $supplier->save();

            return redirect()->back()->with('success', 'Nhà cung cấp đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật nhà cung cấp.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $supplierId = $request->input('MANCC'); 
            $supplier = Supplier::findOrFail($supplierId);
            $supplier->delete();

            return redirect()->back()->with('success', 'Nhà cung cấp đã được xóa thành công.'); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa nhà cung cấp.');
        }
    }
}
