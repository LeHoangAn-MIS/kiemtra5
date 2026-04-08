<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);



Route::get('/openrouter', [OpenRouterController::class, 'chat']);

Route::get('/phim','App\Http\Controllers\MovieController1@phim');
Route::get('/theloai/{id}','App\Http\Controllers\MovieController1@theloai');
Route::get('/chitiet/{id}','App\Http\Controllers\MovieController1@chitiet');
Route::post('/timkiem','App\Http\Controllers\MovieController1@timkiem');

use App\Http\Controllers\AdminMovieController;

Route::get('/quanly/danh-sach-phim', [AdminMovieController::class, 'index'])->name('phim.index');
Route::delete('/quanly/phim/{id}', [AdminMovieController::class, 'destroy'])->name('phim.destroy');