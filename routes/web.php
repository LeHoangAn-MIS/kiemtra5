<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieController2;


Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

Route::get('/openrouter', [OpenRouterController::class, 'chat']);

// Route chức năng phim
Route::get('/phim','App\Http\Controllers\MovieController@phim');
Route::get('/theloai/{id}','App\Http\Controllers\MovieController@theloai');
Route::get('/chitiet/{id}','App\Http\Controllers\MovieController@chitiet');
Route::post('/timkiem','App\Http\Controllers\MovieController@timkiem');

use App\Http\Controllers\AdminMovieController;

// Route trang quản lý phim
Route::get('/quanly/danh-sach-phim', [AdminMovieController::class, 'index'])->name('phim.index');
Route::delete('/quanly/xoa-phim/{id}', [AdminMovieController::class, 'destroy'])->name('phim.destroy');
Route::get('/quanly/them-phim', [AdminMovieController::class, 'create'])->name('phim.create');
Route::post('/quanly/luu-phim', [AdminMovieController::class, 'store'])->name('phim.store');