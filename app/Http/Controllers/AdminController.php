<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method for admin dashboard
    public function index()
    {
        return view('SellerDash');
    }
}
