<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;



Route::get('/startingpage', function () {
    return view('startingpage');
})->name('startingpage');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

// Redirect logic
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('homepage');
    } else {
        return redirect()->route('startingpage');
    }
});


Route::get('/LoginSignUp', function () {
    return view('LoginSignUp'); 
})->name('LoginSignUp');

Route::get('LoginSignupPhoneNo', function () {
    return view('LoginSignupPhoneNo'); 
});

Route::get('AccountVerification', function () {
    return view('AccountVerification'); 
});

Route::get('Register', function () {
    return view('Register'); 
});

Route::get('AccountRecovery', function () {
    return view('AccountRecovery'); 
});

Route::get('AboutPage', function () {
    return view('AboutPage'); 
});


Route::get('/butterfly-bouquet', function () {
    return view('butterflybouquet');
})->name('butterflybouquet');



Route::post('/register', [RegisterController::class, 'register']);

Route::get('/home', [HomeController::class, 'index'])->name('homepage');
 
Route::post('/LoginSignUp', [LoginController::class, 'login'])->name('LoginSignUp');


Route::get('/logout', function () {
    Auth::logout(); // Logs out the user
    session()->invalidate(); // Invalidates the session
    session()->regenerateToken(); // Regenerates the CSRF token

    return redirect('/startingpage'); // Redirect to the homepage
})->name('logout');
// Checkout Route





Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');



Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update');  // For updating quantity
    Route::delete('/cart/delete/{productId}', [CartController::class, 'destroy'])->name('cart.delete');





});


Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/purchasepage', function () {
    return view('purchasepage');
})->name('purchasepage');

Route::get('/searchpage', function () {
    return view('searchpage');
})->name('searchpage');



Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/', function () {
    return view('homepage');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::post('/direct-checkout', [CartController::class, 'directCheckout'])->name('checkout.direct');


Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');



Route::get('/profile', [UserController::class, 'profile'])->name('usersprofile');


Route::get('/AdminDasboard', [AdminController::class, 'index'])->name('AdminDashboard');
Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update.profile');


Route::middleware(['auth'])->group(function () {
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
});
Route::post('/update-password', [UserController::class, 'updatePassword'])->name('password.update');

Route::resource('products', ProductController::class);
Route::get('/admin/products', [ProductController::class, 'showAdminProducts'])->name('admin.products');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
