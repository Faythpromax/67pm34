<?php

use App\Http\Middleware\CheckSessionAge;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckTimeAccess;
use App\Http\Controllers\TestController;


Route::get('', function () {
    return view('home');
});

Route::prefix('product') -> group(function () {
    Route::controller(ProductController::class)->group(function () {
        // Route::get('/', 'index') -> middleware(CheckTimeAccess::class);
        // Route::get('/add', 'create')->name('add') -> middleware(CheckTimeAccess::class);
        // Route::get('/detail/{id?}', 'getDetail') -> middleware(CheckTimeAccess::class);
        // Route::post('/store', 'store');

        Route::get('/age', 'age') -> name('product.age');
        Route::post('/checkAge', 'checkAge')->middleware(CheckAge::class);
        
        Route::get('/login', 'login');
        Route::post('/checklogin', 'checkLogin');
        // Route::get('/logindone', 'loginDone');
        Route::get('/register', 'register');
        Route::post('/checkRegister', 'checkRegister');

        Route::middleware(CheckSessionAge::class)->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/detail/{id?}', 'getDetail');
                Route::get('/add', 'create') -> name('add');
                Route::post('/store', 'store');
            }) -> middleware(CheckTimeAccess::class); 
        });
    });
});

Route::resource('test', TestController::class);

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