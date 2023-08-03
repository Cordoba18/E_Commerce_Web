<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $city = City::where('id', $user->id_ciudad)->first();

        return view('customers.editcustomer',compact('user','city'));
    }
}
