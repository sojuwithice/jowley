<?php

use Illuminate\Support\Facades\Route;

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

Route::get('RegisterAccountVerification', function () {
    return view('RegisterAccountVerification'); 
});
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/minifuzzy', function () {
    return view('minifuzzy');
})->name('minifuzzy');

Route::get('/fuzzylily', function () {
    return view('fuzzylily');
})->name('fuzzylily');

Route::get('/singletulip', function () {
    return view('singletulip');
})->name('singletulip');

Route::get('/butterfly-bouquet', function () {
    return view('butterflybouquet');
})->name('butterflybouquet');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');