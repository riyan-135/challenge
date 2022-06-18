<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('Admin.pages.dashboard');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/book', App\Http\Controllers\BookController::class)->parameters(['book' => 'id'])->middleware('auth');
Route::resource('/author', App\Http\Controllers\CreatedBookController::class)->parameters(['author' => 'id'])->middleware('auth');
Route::resource('user', App\Http\Controllers\UserController::class)->parameters(['author' => 'id']);

Route::get('/front-user', [App\Http\Controllers\UserController::class, 'userFront']);
