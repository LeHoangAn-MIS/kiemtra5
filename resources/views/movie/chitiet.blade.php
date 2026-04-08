<x-movie-layout>
    <x-slot name="title">
        Chi tiết
    </x-slot>

    <style>
        .info {
            display: grid;
            grid-template-columns: 30% 70%;
        }
    </style>

    <h4>{{ $data->movie_name_vn }}</h4>

    <div class="info">
        <div>
            <img src="{{ asset('storage'.$data->image) }}" width="200" height="200">
        </div>

        <div>
            Ngày phát hành: 
            <b>{{ \Carbon\Carbon::parse($data->release_date)->format('Y/m/d') }}</b><br>

            Quốc gia: <b>{{ $data->country_name }}</b><br>
            Thời gian: <b>{{ $data->runtime }} phút</b><br>
            Doanh thu: <b>{{ $data->revenue }}</b><br>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <b>Mô tả:</b><br>
            {{ $data->overview_vn }}
        </div>
    </div>

    <div class='mt-1'>
        <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Xem trailer</button>
    </div>
</x-movie-layout>