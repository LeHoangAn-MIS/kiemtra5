<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController3 extends Controller
{
    public function index()
    {
        $movies = Movie::all(); // lấy tất cả phim
        return view('movie.index3', compact('movies'));
    }

    public function create()
    {
        return view('movie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'rating' => 'nullable|numeric|min:0|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('movies', 'public');
        }

        Movie::create($data);

        return redirect()->route('phim.index')->with('success', 'Phim đã được thêm thành công!');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->image) {
            Storage::disk('public')->delete($movie->image);
        }

        $movie->delete();

        return redirect()->route('phim.index')->with('success', 'Phim đã được xóa thành công!');
    }
}
