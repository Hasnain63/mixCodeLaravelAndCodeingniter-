<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DistributorController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
route::get('/', [AdminController::class, 'index']);
route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::group(['middleware' => 'Admin_auth'], function () {
    route::get('admin/dashboard', [AdminController::class, 'dashboard']);


    // *********************Product**************

    route::get('admin/product', [ProductController::class, 'index']);
    route::get('admin/product/manage_product', [ProductController::class, 'manage_product']);
    route::get('admin/product/manage_product/{id}', [ProductController::class, 'manage_product']);
    route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('manage_product_process');
    route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status']);
    route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);

    // *********************Doctor**************

    route::get('admin/doctor', [DoctorController::class, 'index']);
    route::get('admin/doctor/manage_doctor', [DoctorController::class, 'manage_doctor']);
    route::get('admin/doctor/manage_doctor/{id}', [DoctorController::class, 'manage_doctor']);
    route::post('admin/doctor/manage_doctor_process', [DoctorController::class, 'manage_doctor_process'])->name('manage_doctor_process');
    route::get('admin/doctor/status/{status}/{id}', [DoctorController::class, 'status']);
    route::get('admin/doctor/delete/{id}', [DoctorController::class, 'delete']);

    // *********************Distributor**************

    route::get('admin/distributor', [DistributorController::class, 'index']);
    route::get('admin/distributor/manage_distributor', [DistributorController::class, 'manage_distributor']);
    route::get('admin/distributor/manage_distributor/{id}', [DistributorController::class, 'manage_distributor']);
    route::post('admin/distributor/manage_distributor_process', [DistributorController::class, 'manage_distributor_process'])->name('manage_distributor_process');
    route::get('admin/distributor/status/{status}/{id}', [DistributorController::class, 'status']);
    route::get('admin/distributor/delete/{id}', [DistributorController::class, 'delete']);


    // *********************sale**************

    route::get('admin/sale', [SaleController::class, 'index']);
    route::get('admin/sale/manage_sale', [SaleController::class, 'manage_sale']);
    route::get('admin/sale/manage_sale/{id}', [SaleController::class, 'manage_sale']);
    route::post('admin/sale/manage_sale_process', [SaleController::class, 'manage_sale_process'])->name('manage_sale_process');
    route::get('admin/sale/status/{status}/{id}', [SaleController::class, 'status']);
    route::get('admin/sale/delete/{id}', [SaleController::class, 'delete']);
    route::post('/admin/get_activity', [SaleController::class, 'get_activity'])->name('admin/get_activity');

    // *********************LogOut**************

    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('success', 'Logout successfully');
        return redirect('/');
    });
});