<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/pertemuan8/hal1', function () {
    return view('hal1');
});
Route::get('/pertemuan8/hal2', function () {
    return view('hal2');
});
Route::get('/pertemuan8/hal3', function () {
    return view('hal3');
});

Route::get('/pertemuan8', [HomeController::class, 'jualan']);


// Route::get('/pertemuan8/{nama?}', function ($nama = 'Ga ada') {
//     return view('index', [
//         'nama'=> $nama
//     ]);
// });

Route::get('/controller', [HomeController::class, 'salam']);
Route::get('/controller/kuadrat/{angka1?}&{angka2?}', [HomeController::class, 'kuadrat']);
Route::get('/controller/kali/{angka1?}&{angka2?}', [HomeController::class, 'kali']);
