@extends('layout')
@section('content')
    <div class="content w-50 m-auto mt-5">
        <a href="{{ route('post#home') }} " class="text-decoration-none text-black">
            <i class="fa-solid fa-arrow-left-long"></i> back
        </a>
        <div class="my-3">
            <form action="{{ route('post#update',$data->id) }}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" value="{{ old('title',$data->title) }}" name="title" class="form-control" id="title">

                    @error('title')
                               <span class=" text-danger">{{ $message }}</span>
                    @enderror

                </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class=" form-control" rows="8">{{ old('description',$data->description) }}</textarea>

                    @error('description')
                               <span class=" text-danger">{{ $message }}</span>
                    @enderror

                  </div>
                    @if ($data->image !== NULL)
                        <img class=" w-50 my-3" src="{{ asset("storage/".$data->image) }}" alt="">
                    @endif
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" name='image' type="file" id="formFile">
                        @error('image')
                           <span class=" text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  <button type="submit" class="btn btn-primary float-end">Save</button>
            </form>
        </div>
    </div>
@endsection
