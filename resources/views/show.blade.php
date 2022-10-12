@extends('layout')
@section('content')
    <div class="content w-50 m-auto mt-5">
        <a href="{{ route('post#home') }} " class="text-decoration-none text-black">
            <i class="fa-solid fa-arrow-left-long"></i> back
        </a>
        <h3 class=" my-3">{{ $data->title }}</h3>
        @if ($data->image !== NULL)
            <img class=" w-100 my-3" src="{{ asset("storage/".$data->image) }}" alt="">
        @endif
        <p>{{ $data->description }}</p>
    </div>
@endsection

