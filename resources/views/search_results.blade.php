<x-movie-layout>
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <h4 class="mb-4">Kết quả tìm kiếm cho: "{{ $keyword }}"</h4>

    {{-- Sử dụng class list-movie để tạo lưới 4 cột theo CSS của thầy --}}
    <div class="list-movie">
        @if(count($movies) > 0)
            @foreach($movies as $row)
                {{-- Sử dụng class movie cho từng ô phim --}}
                <div class="movie">
                    <a href="{{ url('/movie/'.$row->id) }}">
                        {{-- Ảnh đại diện lấy từ cột image và dùng storage:link --}}
                        <img src="{{ asset('storage' . $row->image) }}" 
                             alt="{{ $row->movie_name_vn }}" 
                             style="width: 100%; height: 350px; object-fit: cover;">
                        
                        <div class="p-2">
                            <h6 class="mt-2"><b>{{ $row->movie_name_vn }}</b></h6>
                            <p class="text-muted" style="font-size: 0.9em;">{{ $row->release_date }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p class="alert alert-warning">Không tìm thấy bộ phim nào phù hợp với từ khóa.</p>
            </div>
        @endif
    </div>
</x-movie-layout>