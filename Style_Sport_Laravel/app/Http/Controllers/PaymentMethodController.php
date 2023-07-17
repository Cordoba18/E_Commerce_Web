<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return view('customers.paymentMethod');
    }

    public function create()
    {
        return view('customers.addPaymentMethod');
    }
}
