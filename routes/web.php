<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('product')->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('get.products.index');
    Route::post('/index', [ProductController::class, 'index'])->name('post.products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('get.products.create');
    Route::post('/creaste', [ProductController::class, 'create'])->name('post.products.create');
    Route::get('/update/{id}', [ProductController::class, 'update'])->name('get.products.update');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('post.products.update');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('get.products.delete');
});
