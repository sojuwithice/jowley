<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminAnalyticsController;
use App\Http\Controllers\PaymentController;


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

// AUTH ROUTESame('LoginSignUp');

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
//login route
Route::get('/LoginSignUp', function () {
    return view('LoginSignUp'); 
})->name('LoginSignUp');

Route::post('/LoginSignUp', [LoginController::class, 'login'])->name('login.submit');



Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');


Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/logout', function () {
    Auth::logout(); // Logs out the user
    session()->invalidate(); // Invalidates the session
    session()->regenerateToken(); // Regenerates the CSRF token

    return redirect('/startingpage'); 
})->name('logout');
// Checkout Route
Route::get('/checkout', function() {
    if (!Auth::check()) {
        return redirect()->route('LoginSignUp')->with('message', 'Please log in to proceed to checkout.');
    }
    return view('checkout');
})->name('checkout');


Route::get('/SellerDash', [AdminController::class, 'index'])->name('SellerDash');

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
Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');


Route::resource('products', ProductController::class);
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::post('/place-order', [OrderController::class, 'store'])->name('placeOrder');
Route::get('/purchases', [PurchaseController::class, 'showPurchases'])->name('purchasepage');

Route::post('/cancel-order/{order}', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
// Show the Add Product Form
Route::get('/add-product', [AdminProductController::class, 'create'])->name('products.addProduct');


Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
//Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel']);


// Store the new product
Route::post('/add-product', [AdminProductController::class, 'store'])->name('products.storeProduct');
Route::get('/users', [UserController::class, 'index'])->name('users');


Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('analytics');

Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])
    ->name('orders.update-status');
    Route::get('/orders/orders', function() {
        $orders = \App\Models\Order::with(['user', 'orderItems.product'])->latest()->get();
        return view('orders.orders', compact('orders'));
    })->name('orders.orders');

    Route::get('/faqs', function () {
        return view('faqs');
    })->name('faqs');