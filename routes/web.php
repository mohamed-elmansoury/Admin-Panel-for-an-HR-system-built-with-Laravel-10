<?php

use App\Http\Controllers\PhotoController;
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

// Route::get('/', function () {
//     return view('layouts.admin');
// });


// Route::get('test', function () {
//     return view('admin.test');
// });
Route::get('/upload', function () {
    return view('upload');
});

Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');


