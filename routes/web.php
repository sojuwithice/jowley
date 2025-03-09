<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('LoginSignup', function () {
    return view('LoginSignup'); 
});

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