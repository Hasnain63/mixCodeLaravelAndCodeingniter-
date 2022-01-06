<?php

// use App\Http\Controllers\Admin\DashBoardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\AdminController;
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
//     return view('auth/login');
// });

Auth::routes();
route::get('/', [AdminController::class, 'index']);
Route::get('/home', 'HomeController@index')->name('home');

//  route::get('dashboard', [DashBoardController::class, 'index']);
// *************Admin route***************
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('dashboard', 'DashBoardController@index')->name('dashboard');
});





// // ***********User routes*******************
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function () {
    Route::get('dashboard', 'DashBoardController@index')->name('dashboard');
});