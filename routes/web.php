<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserValidationController;
use App\Models\Produk;
use App\Models\UserValidation;

Route::get('/', function () {
    return view('validation_page.valid');
})->name('login');

Route::get('/dashboard',[ProdukController::class,'index'])->name('produk.index');
Route::get('/produk/fetch', [ProdukController::class, 'fetch']);
Route::get('/get-stock/{id}', [ProdukController::class, 'getStock']);
Route::get('/api/orders', [OrderController::class, 'getOrders']);
Route::get('/orders/fetch', [OrderController::class, 'fetchOrders'])->name('orders.fetch');
Route::get('/produk', function () {
    return response()->json(Produk::all());
});
Route::get('/generate/{id_order}', [OrderController::class, 'generatePDF'])->name('generate');

Route::post('/produk/order',[ProdukController::class,'create'])->name('produk.create');
Route::post('/produk/ready',[ProdukController::class,'orderReady'])->name('produk.ready');
Route::post('/validation',[UserValidationController::class,'index'])->name('validation');
Route::post('/register',[UserValidationController::class,'register'])->name('register');
Route::post('/logout',[UserValidationController::class,'logout'])->name('logout');
