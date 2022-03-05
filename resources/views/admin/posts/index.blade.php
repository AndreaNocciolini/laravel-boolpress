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
                            <h4 class="card-title text-center bg-info">{{ $post->category()->first()->name }}</h4>
                            <h4 class="card-title text-center bg-info">By {{ $post->user()->first()->name }}</h4>
                            <h3 class="card-title">{{ $post->title }}</h3>
                            @foreach ($post->tags()->get() as $tag)
                                <h5 class="card-title">{{ $tag->name }}</h5>
                            @endforeach
                            <p class="card-text">{{ $post->content }}</p>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">Read Article</a>

                            {{-- Con questo controllo facciamo in modo che i pulsanti edit e delete siano visibili solo al proprietario del post --}}

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
    </div>
@endsection
