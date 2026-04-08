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

        public function create() {
        $genre = DB::table('genre')->get();
        return view('admin.create', compact('genre'));
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
        DB::insert("INSERT INTO movie (movie_name, movie_name_vn, release_date, overview_vn, image, original_name, status) 
                    VALUES (?, ?, ?, ?, ?, ?, 1)", [
            $request->movie_name,
            $request->movie_name_vn,
            $request->release_date,
            $request->overview_vn,
            $imgName,
            $request->movie_name,
        ]);
        return redirect()->back()->with('success', 'Thêm phim thành công!');
    }
}
