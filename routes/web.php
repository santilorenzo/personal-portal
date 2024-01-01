<?php

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


use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DiaryPostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Signup and login routes
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// DiaryPosts routes
Route::group([], function () {
    Route::get('/diary', [DiaryPostController::class, 'index'])->name('diary_posts.index');
    Route::get('/diary/create', [DiaryPostController::class, 'create'])->name('diary_posts.create');
    Route::post('/diary', [DiaryPostController::class, 'store'])->name('diary_posts.store');
    Route::get('/diary/{diaryPost}', [DiaryPostController::class, 'show'])->name('diary_posts.show');
    Route::get('/diary/{diaryPost}/edit', [DiaryPostController::class, 'edit'])->name('diary_posts.edit');
    Route::put('/diary/{diaryPost}', [DiaryPostController::class, 'update'])->name('diary_posts.update');
    Route::delete('/diary/{diaryPost}', [DiaryPostController::class, 'destroy'])->name('diary_posts.destroy');
});

