<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\SupplierControllerController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PosController;



use App\Http\Controllers\Admin\TestController;



use Illuminate\Support\Facades\Mail;


Route::prefix('admin')->group(function () {

    Route::get('/', [ProductCategoryController::class, 'index'])->name('category.index');
    Route::post('/category/create', [ProductCategoryController::class, 'store'])->name('category.store');
    Route::post('/category/delete', [ProductCategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/update', [ProductCategoryController::class, 'update'])->name('category.update');


    Route::get('/Supplier', [SupplierControllerController::class, 'index'])->name('Supplier.index');
    Route::post('/Supplier/create', [SupplierControllerController::class, 'store'])->name('supplier.store');
    Route::post('/Supplier/delete', [SupplierControllerController::class, 'destroy'])->name('supplier.destroy');
    Route::post('/Supplier/update', [SupplierControllerController::class, 'update'])->name('supplier.update');


    Route::get('/Warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::post('/Warehouse/create', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::post('/Warehouse/delete', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');
    Route::post('/Warehouse/update', [WarehouseController::class, 'update'])->name('warehouse.update');


    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::post('/product/delete', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('/employees/create', [EmployeeController::class, 'store'])->name('employee.store');
    Route::post('/employees/delete', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/employees/update', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/addToCart', [PosController::class, 'addToCart'])->name('pos.addToCart');
    

});
