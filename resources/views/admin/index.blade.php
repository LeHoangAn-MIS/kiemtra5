<x-movie-layout>
    <x-slot name="title">
        DANH SÁCH PHIM
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <a href="{{ route('phim.create') }}" class="btn btn-success mb-3">Thêm</a>

    <table id="movie-table" class="table table-bordered table-hover bg-white">
        <thead class="thead-light">
            <tr>
                <th>Ảnh đại diện</th>
                <th>Tiêu đề</th>
                <th>Giới thiệu</th>
                <th>Ngày phát hành</th>
                <th>Điểm đánh giá</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
            <tr>
                <td>
                    <img src="{{ asset('storage' . $movie->image) }}"
                         width="70"
                         style="border-radius:4px; object-fit:cover; height:90px;">
                </td>
                <td>{{ $movie->movie_name_vn }}</td>
                <td style="max-width:150px">
                    {{ Str::words($movie->overview_vn, 15, '...') }}
                </td>
                <td>{{ $movie->release_date }}</td>
                <td>{{ round($movie->vote_average, 1) }}</td>
                <td style="white-space:nowrap;">
                    <a href="{{ url('/chitiet/' . $movie->id) }}"
                       class="btn btn-primary btn-sm">Xem</a>

                    <form action="{{ route('phim.destroy', $movie->id) }}"
                          method="POST" style="display:inline"
                          onsubmit="return confirm('Xóa phim này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <x-slot name="scripts">
        <script>
        $(document).ready(function () {
            $('#movie-table').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                bStateSave: true,
            });
        });
        </script>
    </x-slot>
</x-movie-layout>