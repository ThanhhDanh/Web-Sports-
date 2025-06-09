<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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



Auth::routes(['verify' => true]);

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});


// Route user
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLogin'])->name('login.showLogin')->middleware(['guest', 'nocache']);;
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegister'])->name('register.showRegister')->middleware('auth');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register.create')->middleware('auth');

Route::get('password/confirm', [\App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm')->middleware('auth');
Route::post('password/confirm', [\App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm'])->middleware('auth');

// Route error
Route::get('/403', function () {
    return view('auth.error.403');
});

// Route Momo
Route::middleware('auth')->group(function () {
    Route::post('/process-payment', [\App\Http\Controllers\MomoController::class, 'process'])->name('momo.process');
});

// Route email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('guest')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/users-management')->with('success', 'Email verified successfully.');
})->middleware(['guest', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification link sent!');
})->middleware(['guest', 'throttle:6,1'])->name('verification.send');


// Route dashboard
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::redirect('/', '/dashboard');
    Route::redirect('/home', '/dashboard');
    Route::get('/dashboard', function () {
        return view('welcome');
    });
})->name('welcome');

// Route products
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/products', [\App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
    Route::get('/product/detail/{product:id}', [\App\Http\Controllers\ProductsController::class, 'showDetail'])->name('products.showDetail');
    Route::get('/product/edit/{product:id}', [\App\Http\Controllers\ProductsController::class, 'edit'])->name('products.edit');
    Route::delete('/product/delete/{product:id}', [\App\Http\Controllers\ProductsController::class, 'destroy'])->name('products.destroy');
    Route::put('/product/update/{product:id}', [\App\Http\Controllers\ProductsController::class, 'update'])->name('products.update');
    Route::get('/products/search', [\App\Http\Controllers\ProductsController::class, 'search'])->name('products.search');
    Route::get('/products/create', [\App\Http\Controllers\ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\ProductsController::class, 'store'])->name('products.store');

    // Route accessories
    Route::get('/products/accessories/colors', [\App\Http\Controllers\AccessoriesController::class, 'color'])->name('accessories.color');
    Route::get('/products/accessories/sizes', [\App\Http\Controllers\AccessoriesController::class, 'size'])->name('accessories.size');
    Route::post('/products/accessories/colors/create', [\App\Http\Controllers\AccessoriesController::class, 'storeColor'])->name('accessories.storeColor');
    Route::post('/products/accessories/sizes/create', [\App\Http\Controllers\AccessoriesController::class, 'storeSize'])->name('accessories.storeSize');
    Route::put('/products/accessories/colors/update/{id}', [\App\Http\Controllers\AccessoriesController::class, 'updateColor'])->name('accessories.updateColor');
    Route::put('/products/accessories/sizes/update/{id}', [\App\Http\Controllers\AccessoriesController::class, 'updateSize'])->name('accessories.updateSize');
});

//Route categories

Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/category/detail/{category:id}', [\App\Http\Controllers\CategoriesController::class, 'showDetail'])->name('categories.showDetail');
    Route::get('/category/edit/{category}', [\App\Http\Controllers\CategoriesController::class, 'edit'])->name('categories.edit');
    Route::delete('/category/delete/{category:id}', [\App\Http\Controllers\CategoriesController::class, 'destroy'])->name('categories.destroy');
    Route::put('/category/update/{category:id}', [\App\Http\Controllers\CategoriesController::class, 'update'])->name('categories.update');
    Route::post('/categories', [\App\Http\Controllers\CategoriesController::class, 'store'])->name('categories.store');
});


//Route users auth
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/profile/{user:id}', [\App\Http\Controllers\Auth\UsersController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit/{user:id}', [\App\Http\Controllers\Auth\UsersController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{user:id}', [\App\Http\Controllers\Auth\UsersController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete/{user:id}', [\App\Http\Controllers\Auth\UsersController::class, 'destroy'])->name('profile.destroy');

    //Route user management
    Route::get('/users-management', [\App\Http\Controllers\ManagementUsersController::class, 'index'])->name('users.index');
});

// Route invoices
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('invoices.index')->middleware('handle.momo.redirect');
    Route::get('/invoices/create', [\App\Http\Controllers\InvoicesController::class, 'create'])->name('invoices.create');
    // Route::post('/invoices', [\App\Http\Controllers\InvoicesController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/search', [\App\Http\Controllers\InvoicesController::class, 'search'])->name('invoices.search');
    Route::get('/invoice/detail/{invoice:id}', [\App\Http\Controllers\InvoicesController::class, 'showDetail'])->name('invoices.showDetail');
    Route::get('/invoice/edit/{invoice:id}', [\App\Http\Controllers\InvoicesController::class, 'edit'])->name('invoices.edit');
});

// Route discounts
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/discount/edit/{discount}', [\App\Http\Controllers\DiscountsController::class, 'edit'])->name('discounts.edit');
    Route::put('/discount/update/{discount:id}', [\App\Http\Controllers\DiscountsController::class, 'update'])->name('discounts.update');
    Route::get('/discounts', [\App\Http\Controllers\DiscountsController::class, 'index'])->name('discounts.index');
    Route::post('/discounts', [\App\Http\Controllers\DiscountsController::class, 'store'])->name('discounts.store');
});

// Route events
Route::get('/events', [\App\Http\Controllers\EventsController::class, 'index'])->name('events.index')->middleware('web');
Route::get('/event/detail/{event:id}', [\App\Http\Controllers\EventsController::class, 'showDetail'])->name('events.showDetail')->middleware('web');
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::get('/events/create', [\App\Http\Controllers\EventsController::class, 'create'])->name('events.create');
    Route::post('/events', [\App\Http\Controllers\EventsController::class, 'store'])->name('events.store');
    Route::get('/event/edit/{event:id}', [\App\Http\Controllers\EventsController::class, 'edit'])->name('events.edit');
    Route::put('/event/update/{event:id}', [\App\Http\Controllers\EventsController::class, 'update'])->name('events.update');
});

//Route comments
Route::get('/comments/{comment:id}', [\App\Http\Controllers\CommentsController::class, 'show'])->name('comments.show')->middleware('web');
Route::get('/comments', [\App\Http\Controllers\CommentsController::class, 'index'])->name('comments.index')->middleware('web');
Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    Route::post('/comments/{comment}/reply', [\App\Http\Controllers\CommentsController::class, 'reply'])->name('comments.reply');
});


//Route carts
Route::middleware('auth')->group(function () {
    Route::get('/carts', [\App\Http\Controllers\CartController::class, 'index'])->name('carts.index')->middleware('web');
    Route::post('/carts', [\App\Http\Controllers\CartController::class, 'store'])->name('carts.store')->middleware('web');
    Route::put('/carts/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('carts.update')->middleware('web');
    Route::delete('/carts/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('carts.destroy')->middleware('web');
});