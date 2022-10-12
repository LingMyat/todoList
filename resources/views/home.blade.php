@extends('layout')
@section('content')
    <div class="row mt-5">
        <div class="col-5">
            {{-- Condition Check using session --}}
            @if (session('created'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('created') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @elseif (session('updated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updated') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @elseif (session('deleted'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('deleted') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @endif
            {{-- Create posts section --}}
            <div class=" card">
                <div class="card-header">
                    <h5>Create Post</h5>
                </div>
                {{-- Create posts form --}}
                <div class="card-body">
                    <form action="{{ route('post#create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">
                            @error('title')
                               <span class=" text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                          <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class=" form-control" rows="8">{{ old('description') }}</textarea>
                            @error('description')
                               <span class=" text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" name='image' type="file" id="formFile">
                            @error('image')
                               <span class=" text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-primary float-end">Create</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- posts section --}}
        <div class="col-7">
            <div class="data-container">
                {{-- search input --}}
                <form action="{{ route('post#home') }}" method="get">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" value="{{ request('search') }}" name='search' class="form-control" aria-label="Sizing example input"
                         aria-describedby="inputGroup-sizing-sm">
                         <button type="submit" class="btn btn-danger">search</button>
                    </div>
                </form>
                {{-- data show condition --}}
                @if (count($data) === 0)
                    <h3 class=" mt-3 text-center text-danger">There is no data with {{ request('search') }}</h3>
                @endif
                {{-- foreach start --}}
                @foreach ($data as $row)
                <div class="post mb-3 p-2 shadow-sm">
                    <div class=" mb-2 d-flex justify-content-between">
                        <h5 class=" ">{{ $row->title }}</h5>
                        <div>{{ $row->created_at->format('d/m/Y | h:iA') }}</div>
                    </div>
                    <p>{{ Str::words($row->description,13,'...') }}</p>
                    <div class="btns text-end">
                        <a href="{{ route('post#show',$row->id) }}" class=" text-decoration-none">
                            <button class="btn btn-sm btn-primary">
                                ဖတ်ရန်
                            </button>
                        </a>
                        <a href="{{ route('post#edit',$row->id) }}" class=" text-decoration-none">
                            <button class="btn btn-sm btn-warning">
                                Edit
                            </button>
                        </a>
                        <a href="{{ route('post#delete',$row->id) }}" class=" text-decoration-none">
                            <button class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"> ဖျက်ရန်</i>
                            </button>
                        </a>
                    </div>
                </div>
                @endforeach
                {{-- Pagination from AppServiceProvider --}}
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
