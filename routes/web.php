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

//Admin
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('/dashboardAdmin', 'Admin\DashboardController');
        Route::resource('/OrderProses', 'Admin\OrderController');
        Route::resource('/user', 'Admin\UserController');
        Route::resource('/produk', 'Admin\ProdukController');
        Route::get('user/{id}/delete', 'Admin\UserController@delete');
        Route::get('produk/{id}/delete', 'Admin\ProdukController@delete');
        Route::get('listProduk', 'Admin\ProdukController@listProduk')
            ->name('produk.listProduk');
        Route::get('emProduk', 'Admin\ProdukController@emProduk')
            ->name('produk.emProduk');
        Route::get('Order/{id}/verify', 'Admin\OrderController@verify')
            ->name('Order.verify');
        Route::get('Order/{id}/batal', 'Admin\OrderController@batal')
            ->name('Order.batal');
        Route::get('Order/{id}/detail', 'Admin\OrderController@detail')
            ->name('Order.detail');
        Route::put('Orderresi/{id}', 'Admin\OrderController@addresi')
            ->name('Order.addresi');
        Route::put('Orderresiview/{id}', 'Admin\OrderController@addresi_view')
            ->name('Order.addresi_view');
        Route::get('Order/selesai', 'Admin\OrderController@selesai')
            ->name('Order.selesai');
        Route::get('Order/Obatal', 'Admin\OrderController@Obatal')
            ->name('Order.Obatal');
        Route::put('editStok/{id}', 'Admin\ProdukController@editStok')
            ->name('Produk.editStok');
    });
});

Route::middleware(['auth', 'can:user'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('/dashboardUser', 'User\DashboardController');
        Route::resource('/produkUser', 'User\ProdukController');
        Route::resource('/OrderReq', 'User\OrderController');
        Route::resource('/Wishlist', 'User\WishlistController');
        Route::resource('/Cart', 'User\CartController');
        Route::put('OrderReq/{id}/konfirmasi', 'User\OrderController@konfirmasi')
            ->name('OrderReq.konfirmasi');
        Route::get('OrderReq/{id}/detail', 'User\OrderController@detail')
            ->name('OrderReq.detail');
        Route::get('OrderReq/{id}/received', 'User\OrderController@received')
            ->name('OrderReq.received');
        Route::get('history', 'User\OrderController@history')
            ->name('OrderReq.history');
        Route::get('Cart/{id}/addCart', 'User\CartController@addCart')
            ->name('Cart.addCart');
        Route::get('Cart/{id}/delCart', 'User\CartController@delCart')
            ->name('Cart.delCart');
        Route::get('Wishlist/{id}/wish', 'User\WishlistController@wish')
            ->name('Wishlist.wish');
        Route::get('Wishlist/{id}/unwish', 'User\WishlistController@unwish')
            ->name('Wishlist.unwish');
        Route::get('Search', 'User\SearchController@index')
            ->name('Search.index');
    });
});

