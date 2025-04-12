<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;


Route::get('/startingpage', function () {
    return view('startingpage');
})->name('startingpage');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

// Redirect logic
Route::get('/', function () {
    return auth()->check() ? redirect()->route('homepage') : redirect()->route('startingpage');
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
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

