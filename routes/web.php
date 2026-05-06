<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/latest_news', [NewsController::class, 'latest'])->name('latest_news');
