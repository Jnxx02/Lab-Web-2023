<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductsController::class);
Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
Route::post('/products/update/{id}', [ProductsController::class, 'update'])->name('update');
Route::get('/products/destroy/{id}', [ProductsController::class, 'destroy'])->name('destroy');