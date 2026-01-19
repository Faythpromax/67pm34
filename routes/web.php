<?php

use Illuminate\Support\Facades\Route;
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

Route::fallback(function () {
    // return redirect('/product');
    return view('error.404');
   });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function () {
//     return view('hello');
// });

// Route::get('/product', function () {
//     return view(view: 'product.index');
// });

// Route::get('/product/add', function () {
//     return view(view: 'product.add');
// })->name(name: 'add');

// Route::get('/product/{id}', action: function (int $id) {
//     return view('product.detail', ['id' => $id]);
// });