<?php

use Illuminate\Support\Facades\Route;
// Route::prefix('product') -> group(function () {
//     Route::get('/', action: function () {
//         return view('product.index');
//     });

//     Route::get('/add', function () {
//         return view('product.add');
//     })->name('add');

//     Route::get('/{id}', function (int $id) {
//         return view('product.detail', ['id' => $id]);
//     });
// });

Route::get('', function () {
    return view('home');
});

Route::prefix('product') -> group(function () {
    Route::get('/', action: function () {
        return view('product.index');
    });

    Route::get('/add', function () {
        return view('product.add');
    })->name('add');

    Route::get('/{id}', function (int $id) {
        return view('product.detail', ['id' => $id]);
        
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