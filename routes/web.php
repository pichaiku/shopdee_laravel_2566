<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\EmployeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();
//welcome
Route::get('/', function () {return view('welcome');});

//dashboard
Route::get('/admin', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');

//order
Route::get('/admin/order', [App\Http\Controllers\OrderController::class, 'index'])->name('admin.order.index');
Route::get('/admin/order/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('admin.order.show');
Route::get('/admin/order/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit'])->name('admin.order.edit');
Route::post('/admin/order/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('admin.order.update');
Route::delete('/admin/order/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('admin.order.destroy');

//customer
Route::get('/admin/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('admin.customer.index');
Route::get('/admin/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('admin.customer.create');
Route::post('/admin/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('admin.customer.store');
Route::get('/admin/customer/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('admin.customer.show');
Route::get('/admin/customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('admin.customer.edit');
Route::post('/admin/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('admin.customer.update');
Route::delete('/admin/customer/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('admin.customer.destroy');

//employee
Route::get('/admin/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('admin.employee.index');;
Route::get('/admin/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('admin.employee.create');
Route::post('/admin/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('admin.employee.store');
Route::get('/admin/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('admin.employee.show');
Route::get('/admin/employee/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('admin.employee.edit');
Route::post('/admin/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('admin.employee.update');
Route::delete('/admin/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('admin.employee.destroy');

//product type
Route::get('/admin/producttype', [App\Http\Controllers\ProductTypeController::class, 'index'])->name('admin.producttype.index');
Route::get('/admin/producttype/create', [App\Http\Controllers\ProductTypeController::class, 'create'])->name('admin.producttype.create');
Route::post('/admin/producttype', [App\Http\Controllers\ProductTypeController::class, 'store'])->name('admin.producttype.store');
Route::get('/admin/producttype/{id}', [App\Http\Controllers\ProductTypeController::class, 'show'])->name('admin.producttype.show');
Route::get('/admin/producttype/{id}/edit', [App\Http\Controllers\ProductTypeController::class, 'edit'])->name('admin.producttype.edit');
Route::post('/admin/producttype/{id}', [App\Http\Controllers\ProductTypeController::class, 'update'])->name('admin.producttype.update');
Route::delete('/admin/producttype/{id}', [App\Http\Controllers\ProductTypeController::class, 'destroy'])->name('admin.producttype.destroy');

//product
Route::get('/admin/product', [App\Http\Controllers\ProductController::class, 'index'])->name('admin.product.index');
Route::get('/admin/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('admin.product.create');
Route::post('/admin/product', [App\Http\Controllers\ProductController::class, 'store'])->name('admin.product.store');
Route::get('/admin/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('admin.product.show');
Route::get('/admin/product/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('admin.product.edit');
Route::post('/admin/product/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('admin.product.update');
Route::delete('/admin/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('admin.product.destroy');

//province
Route::get('/admin/province', [App\Http\Controllers\ProvinceController::class, 'index'])->name('admin.province.index');
Route::get('/admin/province/create', [App\Http\Controllers\ProvinceController::class, 'create'])->name('admin.province.create');
Route::post('/admin/province', [App\Http\Controllers\ProvinceController::class, 'store'])->name('admin.province.store');
Route::get('/admin/province/{id}', [App\Http\Controllers\ProvinceController::class, 'show'])->name('admin.province.show');
Route::get('/admin/province/{id}/edit', [App\Http\Controllers\ProvinceController::class, 'edit'])->name('admin.province.edit');
Route::post('/admin/province/{id}', [App\Http\Controllers\ProvinceController::class, 'update'])->name('admin.province.update');
Route::delete('/admin/province/{id}', [App\Http\Controllers\ProvinceController::class, 'destroy'])->name('admin.province.destroy');

//district
Route::get('/admin/district', [App\Http\Controllers\DistrictController::class, 'index'])->name('admin.district.index');
Route::get('/admin/district/create', [App\Http\Controllers\DistrictController::class, 'create'])->name('admin.district.create');
Route::post('/admin/district', [App\Http\Controllers\DistrictController::class, 'store'])->name('admin.district.store');
Route::get('/admin/district/{id}', [App\Http\Controllers\DistrictController::class, 'show'])->name('admin.district.show');
Route::get('/admin/district/{id}/edit', [App\Http\Controllers\DistrictController::class, 'edit'])->name('admin.district.edit');
Route::post('/admin/district/{id}', [App\Http\Controllers\DistrictController::class, 'update'])->name('admin.district.update');
Route::delete('/admin/district/{id}', [App\Http\Controllers\DistrictController::class, 'destroy'])->name('admin.district.destroy');
Route::get('/admin/district/province/{id}', [App\Http\Controllers\DistrictController::class, 'district']);

//subdistrict
Route::get('/admin/subdistrict', [App\Http\Controllers\SubdistrictController::class, 'index'])->name('admin.subdistrict.index');
Route::get('/admin/subdistrict/create', [App\Http\Controllers\SubdistrictController::class, 'create'])->name('admin.subdistrict.create');
Route::post('/admin/subdistrict', [App\Http\Controllers\SubdistrictController::class, 'store'])->name('admin.subdistrict.store');
Route::get('/admin/subdistrict/{id}', [App\Http\Controllers\SubdistrictController::class, 'show'])->name('admin.subdistrict.show');
Route::get('/admin/subdistrict/{id}/edit', [App\Http\Controllers\SubdistrictController::class, 'edit'])->name('admin.subdistrict.edit');
Route::post('/admin/subdistrict/{id}', [App\Http\Controllers\SubdistrictController::class, 'update'])->name('admin.subdistrict.update');
Route::delete('/admin/subdistrict/{id}', [App\Http\Controllers\SubdistrictController::class, 'destroy'])->name('admin.subdistrict.destroy');
Route::get('/admin/subdistrict/district/{id}', [App\Http\Controllers\SubdistrictController::class, 'subdistrict']);

Route::get('/houseprice', [App\Http\Controllers\HousePriceController::class, 'index'])->name('houseprice.index');
Route::post('/houseprice/predict', [App\Http\Controllers\HousePriceController::class, 'predict'])->name('houseprice.predict');

Route::get('/showToken', [App\Http\Controllers\CustomerController::class, 'showToken'])->name('customer.showToken');
Route::post('/pushbot', [App\Http\Controllers\API\LineBotController::class, 'pushbot']);
 


