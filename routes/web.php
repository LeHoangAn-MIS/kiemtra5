<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieController2;


Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

Route::get('/openrouter', [OpenRouterController::class, 'chat']);


// Route hiển thị form thêm phim
Route::get('/movie/create', [MovieController2::class, 'create'])->name('movie.create');

// Route xử lý lưu phim mới
Route::post('/movie/store', [MovieController2::class, 'store'])->name('movie.store');

//trang chi tiết
Route::get('/movie/{id}', [MovieController2::class, 'show'])->name('movie.detail');

//tìm kiếm theo tên
Route::post('/timkiem', [MovieController2::class, 'search']);

