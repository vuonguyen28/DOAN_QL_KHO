<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('Admin.Employee.index', ['employees' => $employees]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'HONV' => 'required|string|max:255',
            'TENNV' => 'required|string|max:255',
            'NGAYSINH' => 'required|date',
            'GIOITINH' => 'required|string|max:10',
            'CHUCVU' => 'required|string|max:255',
            'DIACHI' => 'required|string|max:255',
            'DIENTHOAI' => 'required|string|max:20',
            'EMAIL' => 'required|string|email|max:255'
        ]);

        $validatedData['MANV'] = random_int(10000,99999);

        $employee = new Employee();
        $employee->fill($validatedData);
        $employee->save();

        return redirect()->back()->with('success', 'Nhân viên đã được thêm thành công.');
    }

    public function update(Request $request)
    {
        try {
            $employeeId = $request->input('MANV');
            $employee = Employee::findOrFail($employeeId);
            $employee->update($request->all());

            return redirect()->back()->with('success', 'Nhân viên đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật nhân viên.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $employeeId = $request->input('MANV');
            $employee = Employee::findOrFail($employeeId);
            $employee->delete();

            return redirect()->back()->with('success', 'Nhân viên đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa nhân viên.');
        }
    }
}
