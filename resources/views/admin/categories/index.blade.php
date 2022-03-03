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
        <div class="row">
            <div class="col text-center mt-3">
                <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Add New Category</a>
            </div>
        </div>
        <div class="row row-cols-4 p-2 g-3">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card text-center h-100">
                        <div class="card-body  bg-{{($category->id % 2) ? 'success' : 'info'}}">
                            <p class="card-text text-center">{{ $category->name }}</p>
                            <a class="btn btn-warning" href="{{ route('admin.categories.show', $category) }}">Show</a>
                            <a class="btn btn-{{($category->id % 2) ? 'info' : 'success'}}" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                            <form class="mt-1" action="{{ route('admin.categories.destroy', $category->id) }}"
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
