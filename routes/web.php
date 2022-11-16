<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PdfController;

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

Route::get('/', [ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
Route::get('/cart', [ClientController::class, 'cart'])->name('cart.index');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::put('/products/{id}/activate', [ClientController::class, 'activate'])->name('products.activate');
Route::put('/products/{id}/deactivate', [ClientController::class, 'deactivate'])->name('products.deactivate');
Route::get('/products/{id}/filter', [ClientController::class, 'filter'])->name('products.filter');

Route::post('/update_quantity/{id}', [ClientController::class, 'update_quantity'])->name('update_quantity');
Route::get('/remove_item_from_cart/{id}', [ClientController::class, 'remove_item_from_cart'])->name('remove_item_from_cart');

Route::get('/addtocart/{id}', [ClientController::class, 'addtocart'])->name('products.cart');

Route::post('/customer_orders',[ClientController::class, 'customer_orders'])->name('customer.order');
Route::get('/view_pdf/{id}',[PdfController::class, 'view_pdf'])->name('view.orders');
Route::resources(['/products'=>ProductController::class,
                '/categories' => CategoryController::class,
                '/sliders' => SliderController::class,
                '/orders' => OrderController::class]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
