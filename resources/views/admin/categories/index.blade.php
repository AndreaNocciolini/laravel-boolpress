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
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card text-center h-100">
                        <div class="card-body  bg-{{($category->id % 2) ? 'success' : 'info'}}">
                            <p class="card-text text-center">{{ $category->name }}</p>
                            <a class="btn btn-warning" href="{{ route('admin.categories.show', $category) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('admin.categories.create', $category) }}">Add New Category</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row p-2">
            <div class="col">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
