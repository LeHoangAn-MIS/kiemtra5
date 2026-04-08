<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phim mới</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Thêm phim mới</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('phim.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Giới thiệu</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Ngày phát hành</label>
            <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date') }}">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Điểm đánh giá</label>
            <input type="number" class="form-control" id="rating" name="rating" step="0.1" min="0" max="10" value="{{ old('rating', 0) }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Thêm phim</button>
        <a href="{{ route('phim.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>

</body>
</html>