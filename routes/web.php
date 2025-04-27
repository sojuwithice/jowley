<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;

// STARTING PAGE & HOMEPAGE
Route::get('/startingpage', function () {
    return view('startingpage');
})->name('startingpage');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

// ROOT REDIRECT BASED ON AUTH
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('homepage');
    } else {
        return redirect()->route('startingpage');
    }
});

// AUTH ROUTES
Route::get('/LoginSignUp', function () {
    return view('LoginSignUp'); 
})->name('LoginSignUp');

Route::post('/LoginSignUp', [LoginController::class, 'login'])->name('login.submit');

Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/home');
})->name('logout');

// OTHER STATIC PAGES
Route::view('/LoginSignupPhoneNo', 'LoginSignupPhoneNo');
Route::view('/AccountVerification', 'AccountVerification');
Route::view('/Register', 'Register');
Route::view('/AccountRecovery', 'AccountRecovery');
Route::view('/AboutPage', 'AboutPage');
Route::view('/butterfly-bouquet', 'butterflybouquet')->name('butterflybouquet');
Route::view('/purchasepage', 'purchasepage')->name('purchasepage');
Route::view('/searchpage', 'searchpage')->name('searchpage');

// SHOP PAGE (Controller Based)
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// PRODUCT PAGES
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// SELLER DASHBOARD
Route::get('/SellerDash', [AdminController::class, 'index'])->name('SellerDash');

// CART ROUTES (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/delete/{productId}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post('/direct-checkout', [CartController::class, 'directCheckout'])->name('checkout.direct');
});

// CHECKOUT PAGE
Route::get('/checkout', function () {
    if (!Auth::check()) {
        return redirect()->route('LoginSignUp')->with('message', 'Please log in to proceed to checkout.');
    }
    return view('checkout');
})->name('checkout');

// PURCHASE PAGE
Route::view('/purchasepage', 'purchasepage')->name('purchasepage');




