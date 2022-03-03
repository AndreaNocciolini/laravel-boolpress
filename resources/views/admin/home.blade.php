@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
        </div>
        <div class="row p-4 d-flex align-items-center justify-content-around">
            <div class="col-6 d-flex align-items-center justify-content-around">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-success">Posts</a>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-warning">Add New Post</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-dark text-white">Categories</a>
                @auth
                    <a href="{{ route('admin.home') }}" class="btn btn-info">{{ Auth::user()->name }}</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
