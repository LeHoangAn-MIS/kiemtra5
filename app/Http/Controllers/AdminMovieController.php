<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = DB::select("SELECT * FROM movie WHERE status = 1");
        $genre  = DB::select("SELECT * FROM genre");

        return view('admin.index', compact('movies'));
    }

    public function destroy($id)
    {
        DB::update("UPDATE movie SET status = 0 WHERE id = ?", [$id]);
        $genre  = DB::select("SELECT * FROM genre");

        return redirect()->route('phim.index')
            ->with('success', 'Đã xóa phim thành công!');
    }
}
