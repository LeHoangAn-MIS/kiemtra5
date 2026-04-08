<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController1 extends Controller
{
    //
    public function index(){
        return view("movie.index");
    }

    function phim()
    {
        $data = DB::select("select * from movie 
                            where popularity > 450
                            and vote_average > 7
                            order by release_date desc 
                            limit 12");
        return view("movie.index1", compact("data"));
    }

    function theloai($id)
    {
        $data = DB::select("
            SELECT m.*, g.genre_name_vn
            FROM movie m
            JOIN movie_genre mg ON m.id = mg.id_movie
            JOIN genre g ON mg.id_genre = g.id
            WHERE g.id = ?
            ORDER BY m.release_date DESC
            LIMIT 12
        ", [$id]);

        $genre = DB::select("select * from genre");

        return view("movie.index1", compact("data", "genre"));
    }

    function chitiet($id)
    {
        $data = DB::select("select * from movie where id = ?",[$id])[0];
        return view("movie.chitiet",compact("data"));
    }

    public function timkiem(Request $request)
    {
        $keyword = $request->keyword;

        $data = DB::select("select * from movie where movie_name_vn like ?",["%".$keyword."%"]);

        $genre = DB::select("SELECT * FROM genre");

        return view("movie.index1", compact("data", "genre"));
    }
}
