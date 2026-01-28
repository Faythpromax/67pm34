<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Middleware\CheckTimeAccess;

class ProductController extends Controller
{
    public function index() {
        $title = "Product List";
        return view ('product.index', ['title' => $title,
        'product' => [
            ['id' => 1, 'name' => 'Product A', 'price' => 100],
            ['id' => 2, 'name' => 'Product B', 'price' => 200],
            ['id' => 3, 'name' => 'Product C', 'price' => 300],
        ]]);
    }

    public function getDetail(string $id = "123") {
        return view ('product.detail', ['id' => $id]);
    }

    public function create() {
        return view ('product.add');
    }

    public function store(Request $request) {
        var_dump($request->input('name'));
    }

    public function login() {
        return view ('product.login');
    }

    public function loginDone() {
        return view ('product.logindone');
    }

    public function checkLogin(Request $request) {
        $name = $request->input('name');
        $password = $request->input('password');

        if ($name === 'LXH' && $password === '123456') {
            // return redirect('/product/logindone')->with('loginState', 'Dang nhap thanh cong');
            return "Dang nhap thanh cong";
        } else {
            // return redirect('/product/login')->with('loginState', 'Dang nhap that bai');
            return "Dang nhap that bai";
        }
    }

    public function register() {
        return view ('product.register');
    }

    public function checkRegister(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'fullname' => 'required|string',
            'password' => 'required|string',
        ]);

        var_dump($request->input('name'));
        var_dump($request->input('fullname'));
        var_dump($request->input('password'));
    }

    public function age() {
        return view ('product.age');
    }

    public function checkAge(Request $request)
    {
        // Nếu middleware cho qua => chắc chắn >=18
        session([
            'age_verified' => true,
            'age' => $request->age
        ]);

        return redirect('/product');
    }
}
