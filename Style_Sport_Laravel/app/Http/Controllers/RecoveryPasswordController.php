<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecoveryPasswordController extends Controller
{
    public function index()
    {
        return view('users.recoverPassword');
    }
}
