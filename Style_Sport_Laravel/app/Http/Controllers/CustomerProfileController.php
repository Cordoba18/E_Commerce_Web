<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function index()
    {
        return view('customers.customerProfile');
    }
}
