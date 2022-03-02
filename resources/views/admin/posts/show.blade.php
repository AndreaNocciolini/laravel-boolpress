@extends('layouts.postLayout')

@section('content')
    <div class="container" style="height: 100vh">
        <div class="row w-100 h-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center p-2">
                            <img src="https://www.geometrian.it/wp-content/uploads/2016/12/image-placeholder-500x500.jpg"
                                class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title text-center bg-info">{{ $post->category()->first()->name}}</h4>
                                <h4 class="card-title text-center bg-info">By {{ $post->user()->first()->name }}</h4>
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100 h-100 justify-content-center align-items-center">
                    <div class="col d-flex">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-success">Posts</a>

                        @if (Auth::user()->id === $post->user_id)
                        <form class="ms-2" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete Post">
                        </form>
                        @endif

                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection
