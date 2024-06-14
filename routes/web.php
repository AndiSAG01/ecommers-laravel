<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\OrderController as OrdersController;
use App\Http\Controllers\Frontend\DashboardController as DashboardsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [HomePageController::class, 'index'])->name('front.index');
Route::get('/product/search', [HomePageController::class, 'searchProduct'])->name('front.product_search');
Route::get('/product/{slug}', [HomePageController::class, 'show'])->name('front.show');
Route::get('/product/category/{slug}', [HomePageController::class, 'categoryProduct'])->name('front.category');
Route::get('/product/color/{color}', [HomePageController::class, 'colorProduct'])->name('front.color');
Route::get('/shop', [HomePageController::class, 'shop'])->name('front.shop');

Route::post('cart', [CartController::class, 'addToCart'])->name('front.cart');
Route::get('/cart', [CartController::class, 'listCart'])->name('front.list_cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('front.update_cart');
Route::delete('/cart/delete', [CartController::class, 'deleteCart'])->name('front.delete_cart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/checkout/processCheckout', [CartController::class, 'processCheckout'])->name('front.store_checkout');
Route::get('/checkout/{invoice}', [CartController::class, 'checkoutFinish'])->name('front.finish_checkout');

Route::group(['prefix' => 'customer', 'namespace' => 'Frontend'], function() {
    Route::get('login', [AuthController::class, 'loginForm'])->name('customer.login');
    Route::post('login', [AuthController::class, 'login'])->name('customer.post_login');

    Route::get('register', [AuthController::class, 'registerForm'])->name('customer.register');
    Route::post('register', [AuthController::class, 'register'])->name('customer.post_register');
    Route::get('verify/{token}', [HomePageController::class, 'verifyCustomerRegistration'])->name('customer.verify');
});

Route::prefix('customer')->middleware(['customer'])->group(function () {
    Route::get('account', [DashboardsController::class, 'account'])->name('customer.account');
    Route::get('setting', [DashboardsController::class, 'setting'])->name('customer.setting');
    Route::post('setting', [DashboardsController::class, 'settingUpdate'])->name('customer.post_setting');
    Route::get('logout', [AuthController::class, 'logout'])->name('customer.logout');

    Route::get('orders', [OrdersController::class, 'index'])->name('customer.orders');
    Route::post('orders/accept', [OrdersController::class, 'acceptOrder'])->name('customer.order_accept');
    Route::get('orders/{invoice}', [OrdersController::class, 'view'])->name('customer.view_order');
    Route::get('orders/pdf/{invoice}', [OrdersController::class, 'pdf'])->name('customer.order_pdf');
    Route::get('orders/return/{invoice}', [OrdersController::class, 'returnForm'])->name('customer.order_return');
    Route::put('orders/return/{invoice}', [OrdersController::class, 'processReturn'])->name('customer.return');

    Route::get('payment/{invoice}', [OrdersController::class, 'paymentForm'])->name('customer.paymentForm');
    Route::post('payment/save', [OrdersController::class, 'storePayment'])->name('customer.storePayment');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/category', CategoryController::class)->except(['show']);
    Route::resource('/product', ProductController::class)->except(['show']);

    Route::group(['prefix' => 'order'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/{invoice}', [OrderController::class, 'view'])->name('order.view');
        Route::get('/payment/{invoice}', [OrderController::class, 'acceptPayment'])->name('order.approve_payment');
        Route::get('/return/{invoice}', [OrderController::class, 'return'])->name('order.return');
        Route::post('/return', [OrderController::class, 'acceptReturn'])->name('order.approve_return');
        Route::post('/shipping', [OrderController::class, 'shippingOrder'])->name('order.shipping');
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    });

    Route::group(['prefix' => 'report'], function() {
        Route::get('/order', [DashboardController::class, 'orderReport'])->name('report.order');
        Route::get('/order/pdf/{daterange}', [DashboardController::class, 'orderReportPdf'])->name('report.order_pdf');

        Route::get('/return', [DashboardController::class, 'returnReport'])->name('report.return');
        Route::get('/return/pdf/{daterange}', [DashboardController::class, 'returnReportPdf'])->name('report.return_pdf');

        Route::get('/product', [DashboardController::class, 'productReport'])->name('report.product');
        Route::get('/product/pdf/{daterange}', [DashboardController::class, 'productReportPdf'])->name('report.product_pdf');
    });
});
