<x-movie-layout>
    <x-slot name="title">Thêm phim mới</x-slot>

    <h4 class="text-center text-primary mb-4">THÊM PHIM</h4>

    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label>Tên tiếng Anh</label>
            <input type="text" name="movie_name" class="form-control" value="{{ old('movie_name') }}">
            @error('movie_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Tên tiếng Việt</label>
            <input type="text" name="movie_name_vn" class="form-control" value="{{ old('movie_name_vn') }}">
            @error('movie_name_vn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Ngày phát hành (yyyy-mm-dd)</label>
            <input type="text" name="release_date" class="form-control" placeholder="2023-12-14" value="{{ old('release_date') }}">
            @error('release_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
            <label>Mô tả</label>
            <textarea name="overview_vn" class="form-control" rows="4">{{ old('overview_vn') }}</textarea>
            @error('overview_vn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-4">
            <label>Ảnh đại diện</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Lưu</button>
        </div>
    </form>
</x-movie-layout>
