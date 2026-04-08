<x-movie-layout>
    <x-slot name="title">
        {{ $movie->movie_name_vn }}
    </x-slot>

    <div class="movie-detail-container">
        <h2 style="color: #333; margin-bottom: 20px;">
            {{ $movie->movie_name_vn }} - {{ $movie->movie_name }}
        </h2>
        
        <div class="movie-info">
            <div class="movie-img">
                <img src="{{ asset('storage'. $movie->image) }}" 
                     alt="{{ $movie->movie_name_vn }}" 
                     style="width: 100%; border-radius: 5px; shadow: 0 4px 8px rgba(0,0,0,0.1)">
            </div>

            <div class="movie-content" style="padding-left: 30px;">
                <p><strong>Ngày phát hành:</strong> {{ $movie->release_date }}</p>
                <p><strong>Quốc gia:</strong> {{ $movie->country_name }}</p>
                <p><strong>Thời gian:</strong> {{ $movie->runtime }} phút</p>
                <p><strong>Doanh thu:</strong> {{ $movie->revenue ? number_format($movie->revenue) : 'Đang cập nhật' }}</p>
                
                <p><strong>Mô tả:</strong></p>
                <p style="text-align: justify; line-height: 1.6;">
                    {{ $movie->overview_vn ?? $movie->overview }}
                </p>
                
                @if($movie->trailer)
                    <a href="{{ $movie->trailer }}" target="_blank" 
                       style="display: inline-block; background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-top: 15px;">
                       <i class="fa fa-play-circle"></i> Xem trailer
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-movie-layout>