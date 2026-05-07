<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/latest_news', [NewsController::class, 'latest'])->name('latest_news');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard route - only accessible to authenticated users
Route::get('/dashboard', [VisitController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/point1', function () {
    return view('point1');
});
Route::get('/point2', function () {
    return view('point2');
});
Route::get('/point3', function () {
    return view('point3');
});
