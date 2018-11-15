<?php

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
Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/dashboardAdmin', 'Admin\DashboardController@index');
//Admin
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('/user', 'Admin\UserController');
        Route::resource('/produk', 'Admin\ProdukController');
        Route::resource('/dashboardAdmin', 'Admin\DashboardController');
        Route::resource('/OrderProses', 'Admin\OrderController');
        Route::get('user/{id}/delete', 'Admin\UserController@delete');
        Route::get('produk/{id}/delete', 'Admin\ProdukController@delete');
    });
});

Route::middleware(['auth', 'can:user'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('/dashboardUser', 'User\DashboardController');
        Route::resource('/OrderReq', 'User\OrderController');
        Route::resource('/produkUser', 'User\ProdukController');
    });
});

