<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;

Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);



Route::get('/openrouter', [OpenRouterController::class, 'chat']);

Route::get('/phim','App\Http\Controllers\MovieController@phim');
Route::get('/theloai/{id}','App\Http\Controllers\MovieController@theloai');
Route::get('/chitiet/{id}','App\Http\Controllers\MovieController@chitiet');
Route::post('/timkiem','App\Http\Controllers\MovieController@timkiem');

use App\Http\Controllers\AdminMovieController;

Route::get('/quanly/danh-sach-phim', [AdminMovieController::class, 'index'])->name('phim.index');
Route::delete('/quanly/phim/{id}', [AdminMovieController::class, 'destroy'])->name('phim.destroy');