<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('', function () {
    return view('home');
});

Route::prefix('product') -> group(function () {
    // Route::get('/', action: function () {
    //     return view('product.index');
    // });

        Route::controller(ProductController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'create')->name('add');
            Route::get('/detail/{id?}', 'getDetail');
            Route::post('/store', 'store');
            Route::post('/checklogin', 'checkLogin');
            Route::get('/login', 'login');
            Route::get('/logindone', 'loginDone');
            Route::get('/register', 'register');
            Route::post('/checkRegister', 'checkRegister');
        });

    // Route::get('/', [ProductController::class, 'index']);
    // Route::get('/add', [ProductController::class, 'create'])->name('add');
    // Route::get('/detail/{id?}', [ProductController::class, 'getDetail']);
});

Route::get('sinhvien', function () {
    return view('sinhvien.detail', ['name' => 'Luong Xuan Hieu', 'mssv' => 123456]);
});

Route::get('sinhvien/{name}/{mssv?}', function (string $name, string $mssv = '123456') {
        return view('sinhvien.detail', ['name' => $name,'mssv' => $mssv]);
    });

Route::get('banco/{n?}', function (int $n = 3) {
    if ($n < 1) $n = 1;
    return view('banco.index', ['n' => $n]);
});

Route::fallback(function () {
    // return redirect('/product');
    return view('error.404');
   });