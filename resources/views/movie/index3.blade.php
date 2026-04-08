<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phim</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap.min.css') }}">
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>DANH SÁCH PHIM</h2>
        <a href="{{ route('phim.create') }}" class="btn btn-primary">Thêm phim mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table id="id-table" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Giới thiệu</th>
                    <th>Ngày phát hành</th>
                    <th>Điểm</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
                @foreach($movies as $movie)
                <tr>
                    <td>
                        @if($movie->image)
                            <img src="{{ asset('storage/'.$movie->image) }}" width="80" class="img-thumbnail">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->description ?? 'N/A' }}</td>
                    <td>{{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $movie->rating }}</td>
                    <td>
                        <form action="{{ route('phim.destroy', $movie->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa phim này?')">Xóa</button>
                        </form>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>
<!-- DataTable JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#id-table').DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
        stateSave: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
        }
    });
});
</script>

</body>
</html>