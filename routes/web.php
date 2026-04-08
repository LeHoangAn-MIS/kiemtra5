<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController3;

Route::resource('phim', MovieController3::class)->parameters(['phim' => 'movie']);
