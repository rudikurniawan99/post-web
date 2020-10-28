<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Home\PostController as HomePostController;
use App\Http\Controllers\PostController;
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
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('post', PostController::class);
});

Route::prefix('post')->group(function() {
    Route::get('/', [HomePostController::class, 'index'])->name('home.post');
    // Route::get('show/{post:slug}',[HomePostController::class, 'show'])->name('home.show');
    Route::get('show/{id}',[HomePostController::class, 'show'])->name('home.show');
});