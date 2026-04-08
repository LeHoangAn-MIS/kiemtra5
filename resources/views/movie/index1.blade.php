<x-movie-layout>
    <x-slot name="title">
        Movie
    </x-slot>

    <div class='list-movie'>
        @foreach($data as $row)
            <div class='movie'>
                <a href="{{url('/chitiet/'.$row->id)}}">
                    <img src="{{asset('storage'.$row->image)}}" width='200px' height='200px'><br>
                    <b>{{$row->movie_name}}</b><br/>
                    <i>{{ \Carbon\Carbon::parse($row->release_date)->format('Y/m/d') }}</i>
                </a>
            </div>
        @endforeach
    </div>
</x-movie-layout>

