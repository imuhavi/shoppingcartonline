<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

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
Route::get('/checkout', [ClientController::class, 'checkout']);
Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/login', [ClientController::class, 'login']);
Route::get('/test', [AdminController::class, 'index'])->name('admin.index');
Route::put('/products/{id}/activate', [ClientController::class, 'activate'])->name('products.activate');
Route::put('/products/{id}/deactivate', [ClientController::class, 'deactivate'])->name('products.deactivate');
Route::get('/products/{id}/filter', [ClientController::class, 'filter'])->name('products.filter');

Route::get('/addtocart/{id}', [ClientController::class, 'addtocart'])->name('products.cart');

Route::resources(['/products'=>ProductController::class,
                '/categories' => CategoryController::class,
                '/sliders' => SliderController::class,
                '/orders' => OrderController::class]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
