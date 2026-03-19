<?php

use App\Http\Middleware\CheckSessionAge;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckTimeAccess;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::get('', function () {
    return view('home');
});

Route::get('/admin', function () {
    return view('/layout/admin');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/checklogin', [AuthController::class, 'checkLogin']) -> name('checkLogin');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/checkRegister', [AuthController::class, 'checkRegister']) -> name('checkRegister');
// Route::resource(name: 'product', ProductController::class);

Route::prefix('product') -> group(function () {
    Route::controller(ProductController::class)->group(function () {

        Route::get('/age', 'age') -> name('product.age');
        Route::post('/checkAge', 'checkAge')->middleware(CheckAge::class);
        
        // Route::get('/login', 'login');
        // Route::post('/checklogin', 'checkLogin');


        Route::get('/', action: 'index');
        Route::get('/detail/{id?}', 'getDetail');
        Route::get('/add', 'create');
        Route::post('/store', 'store');

        Route::get('/edit/{id?}', 'edit');
        Route::post('/update/{id?}', 'update');
        Route::post('/delete/{id?}', 'delete');

        // Route::middleware(CheckSessionAge::class)->group(function () {
        //     Route::controller(ProductController::class)->group(function () {
        //         Route::get('/', 'index');
        //         Route::get('/detail/{id?}', 'getDetail');
        //         Route::get('/add', 'create') -> name('add');
        //         Route::post('/store', 'store');
        //     }) -> middleware(CheckTimeAccess::class); 
        // });
    });
});

Route::prefix('category')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update/{id}', 'update');
        Route::post('/delete/{id}', 'destroy');
    });
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