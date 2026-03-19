<?php

namespace App\Http\Controllers;
use Hash;
use App\Models\User;
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

    public function register() {
        return view ('product.register');
    }
    public function checkRegister(Request $request) {
    // Validate input
    $request->validate([
        'name' => 'required',
        'fullname' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:1'
    ]);

    // Create user
    $user = User::create([
        'name' => $request->name,
        'fullname' => $request->fullname,
        'email' => $request->email,
        'password' => Hash::make($request->password) 
    ]);

    return redirect('/login')->with('success', 'Registration successful. Please log in.');
}
}