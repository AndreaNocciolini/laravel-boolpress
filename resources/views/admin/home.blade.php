@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row p-4 d-flex align-items-center justify-content-around">
            <div class="col-6 d-flex align-items-center justify-content-around">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-success">My Posts</a>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-warning">Add New Post</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark text-white">Categories</a>
                @auth
                    <a href="{{ route('admin.home') }}" class="btn btn-info">Home</a>
                @endauth
            </div>
        </div>
        @guest
            <div class="row">
                <div class="col text-center">
                    <h1>Please, connect to view the site's content.</h1>
                </div>
            </div>
        @endguest
        @auth
            <div class="row row-cols-4 p-2 g-3">
                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h4 class="card-title text-center bg-info">{{ $post->category()->first()->name }}</h4>
                                <h4 class="card-title text-center bg-info">By {{ $post->user()->first()->name }}</h4>
                                <h3 class="card-title">{{ $post->title }}</h3>
                                @foreach ($post->tags()->get() as $tag)
                                    <h5 class="card-title">{{ $tag->name }}</h5>
                                @endforeach
                                <p class="card-text">{{ $post->content }}</p>
                                <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">Read Article</a>

                                @if (Auth::user()->id === $post->user_id)
                                    <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post) }}">Edit Post</a>
                                    <form class="mt-1" action="{{ route('admin.posts.destroy', $post->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Delete Post">
                                    </form>
                                @endif

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
        @endauth
    </div>
@endsection
