<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Home\PostController as HomePostController;
use App\Http\Controllers\Home\HomeController as HomeHomeController;
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

Route::get('/', [HomeHomeController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('post', PostController::class)->except('show');
    Route::get('post/{category:slug}/{post:slug}', [PostController::class, 'show'])->name('post.show');

    Route::resource('category', CategoryController::class)->except('show');
    
});

Route::prefix('post')->group(function() {
    Route::get('/', [HomePostController::class, 'index'])->name('home.post');
    // Route::get('show/{post:slug}',[HomePostController::class, 'show'])->name('home.show');
    Route::get('show/{id}',[HomePostController::class, 'show'])->name('home.post.show');
    Route::get('{category:slug}', [CategoryController::class, 'show'])->name('home.post.category.show');
});