@extends('layouts.postLayout')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row row-cols-4 p-2 g-3">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ $post->content }}</p>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">Read Article</a>
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post) }}">Edit Post</a>
                            <form class="mt-1" action="{{ route('admin.posts.destroy', $post->id) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete Post">
                            </form>
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
