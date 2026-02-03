<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('product.login');
    }

    public function checkLogin(Request $request) {
        $account =  $request -> only('email', 'password');
        if(Auth::attempt($account)) {
            return redirect('/product');
        };
        return redirect('/login')->with('error', 'Invalid credentials');
    }
}