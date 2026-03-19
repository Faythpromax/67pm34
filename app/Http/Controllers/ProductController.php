<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // public function index() {
    //     $title = "Product List";
    //     return view ('product.index', ['title' => $title,
    //     'product' => [
    //         ['id' => 1, 'name' => 'Product A', 'price' => 100],
    //         ['id' => 2, 'name' => 'Product B', 'price' => 200],
    //         ['id' => 3, 'name' => 'Product C', 'price' => 300],
    //     ]]);
    // }

    public function index()
    {
        $product = Product::all();
        return view('admin.product.index', ['products' => $product]);
    }

    public function getDetail(string $id = "123") {
        return view ('admin.product.detail', ['id' => $id]);
    }

    public function create() {
        return view ('admin.product.add');
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product -> name = $request -> input('name');
        $product -> price = $request -> input('price');
        $product -> stock = $request -> input('stock');
        $product -> save();

        return redirect('/product');
    }

    public function edit(string $id)
    {
        return view('admin.product.edit', ['product' => Product::find($id)]);
    }

    public function update(Request $request, string $id)
    {
        //
        $product = Product::find($id);
        $product -> name = $request -> input('name');
        $product -> price = $request -> input('price');
        $product -> stock = $request -> input('stock');

        $product -> save();

        return redirect('/product');
    }

    public function delete(string $id)
    {
        $product = Product::find($id);
        $product -> delete();
        return redirect('/product');
    }

    // public function login() {
    //     return view ('product.login');
    // }

    public function loginDone() {
        return view ('product.logindone');
    }
    
    // public function checkLogin(Request $request) {
    //     $name = $request->input('name');
    //     $password = $request->input('password');

    //     if ($name === 'LXH' && $password === '123456') {
    //         // return redirect('/product/logindone')->with('loginState', 'Dang nhap thanh cong');
    //         return "Dang nhap thanh cong";
    //     } else {
    //         // return redirect('/product/login')->with('loginState', 'Dang nhap that bai');
    //         return "Dang nhap that bai";
    //     }
    // }


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
