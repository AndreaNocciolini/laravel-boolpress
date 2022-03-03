@extends('layouts.postLayout')

@section('content')
    <div class="container">
        <div class="row w-100 h-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title bg-dark text-white">{{ $category->id }}</h2>
                        <h2 class="card-title bg-success">{{ $category->name }}</h2>
                        @foreach ($category->post()->get() as $post)
                        <div class="card-body">
                            <h4 class="card-title text-center bg-info">{{ $post->category()->first()->name}}</h4>
                            <h4 class="card-title text-center bg-info">By {{ $post->user()->first()->name }}</h4>
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                        @endforeach
                        <div class="card-title">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark text-white">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
