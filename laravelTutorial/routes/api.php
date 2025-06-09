<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/momo-ipn', [\App\Http\Controllers\MomoController::class, 'ipn']);

// Route products
Route::get('/products', [\App\Http\Controllers\ProductsController::class, 'index'])->name('products.index')->middleware('web');
Route::get('/product/detail/{product:id}', [\App\Http\Controllers\ProductsController::class, 'showDetail'])->name('products.showDetail')->middleware('web');
Route::get('/products/search', [\App\Http\Controllers\ProductsController::class, 'search'])->name('products.search')->middleware('web');


// Route categories
Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('categories.index')->middleware('web');
Route::get('/category/detail/{category:id}', [\App\Http\Controllers\CategoriesController::class, 'showDetail'])->name('categories.showDetail')->middleware('web');

//Route checkout
Route::post('/checkout', [\App\Http\Controllers\InvoicesController::class, 'store'])->name('invoices.store')->middleware('web');
