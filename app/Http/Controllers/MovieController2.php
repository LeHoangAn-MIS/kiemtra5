<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class MovieController2 extends Controller
{
    // Movie detail
    public function show($id)
    {
    // Lấy thông tin phim cụ thể
        $movie = DB::table('movie')->where('id', $id)->first();
    
        if (!$movie) { abort(404); }
        $genre = DB::table('genre')->get(); 

        return view('detail', [
            'movie' => $movie,
            'genre' => $genre,
            'title' => $movie->movie_name_vn
        ]);
    }

    // Tìm kiếm theo tên
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $movies = DB::select("select * from movie where movie_name_vn like ?", ["%".$keyword."%"]);

        $genre = DB::table('genre')->get();

        return view('search_results', [
            'movies' => $movies,
            'genre' => $genre,
            'title' => 'Kết quả tìm kiếm: ' . $keyword,
            'keyword' => $keyword
        ]);
    }


    public function create() {
        $genre = DB::table('genre')->get();
        return view('create_movie', compact('genre'));
    }

    public function store(Request $request) {
    // 1. Kiểm tra dữ liệu bắt buộc và định dạng ảnh (Validation)
        $request->validate([
            'movie_name' => 'required',
            'movie_name_vn' => 'required',
            'release_date' => 'required|date_format:Y-m-d',
            'overview_vn' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
        // Thông báo lỗi bằng tiếng Việt theo yêu cầu
            'required' => ':attribute không được để trống.',
            'image' => 'File tải lên phải là định dạng ảnh.',
            'mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'date_format' => 'Ngày phát hành phải nhập theo định dạng yyyy-mm-dd.',
        ], [
            'movie_name' => 'Tên tiếng Anh',
            'movie_name_vn' => 'Tên tiếng Việt',
            'release_date' => 'Ngày phát hành',
            'overview_vn' => 'Mô tả',
            'image' => 'Ảnh đại diện',
        ]);

    // 2. Xử lý lưu ảnh vào storage/app/public
        $imgName = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgName = '/' . $file->getClientOriginalName();
            $file->storeAs('public', $imgName);
        }

    // 3. Lưu vào Database
        Movie::create([
            'movie_name' => $request->movie_name,
            'movie_name_vn' => $request->movie_name_vn,
            'release_date' => $request->release_date,
            'overview_vn' => $request->overview_vn,
            'image' => $imgName,
            'original_name' => $request->movie_name,
            'status' => 1, // Luôn mặc định là 1 khi thêm mới[cite: 1]
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Thêm phim thành công!');
    }
  
}