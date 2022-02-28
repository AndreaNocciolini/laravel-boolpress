@extends('layouts.postLayout')

@section('content')
    <div class="container">
        <div class="row row-cols-4 p-2 g-3">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ $post->content }}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">Read Article</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row p-2">
            <div class="col">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
