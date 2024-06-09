<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('Admin.Warehouse.index', ['warehouses' => $warehouses]);
    }

    public function store(Request $request)
    {
        $warehouseName = $request->input('TENKHO');

        $validatedData = $request->validate([
            'TENKHO' => 'required|string|max:255',
            'DIACHI' => 'required|string|max:255',
        ]);

        $validatedData['MAKHO'] = strtoupper(Str::random(10)); // Tạo mã ngẫu nhiên cho kho

        $warehouse = new Warehouse();
        $warehouse->fill($validatedData);
        $warehouse->save();

        return redirect()->back()->with('success', 'Kho đã được thêm thành công.');
    }

    public function update(Request $request)
    {
        try {
            $warehouseId = $request->input('MAKHO');
            $warehouseName = $request->input('TENKHO');
            $warehouseAddress = $request->input('DIACHI');

            $warehouse = Warehouse::findOrFail($warehouseId);
            $warehouse->TENKHO =  $warehouseName;
            $warehouse->DIACHI = $warehouseAddress;
            $warehouse->save();

            return redirect()->back()->with('success', 'Thông tin kho đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin kho.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $warehouseId = $request->input('MAKHO');
            $warehouse = Warehouse::findOrFail($warehouseId);
            $warehouse->delete();

            return redirect()->back()->with('success', 'Kho đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa kho.');
        }
    }
}
