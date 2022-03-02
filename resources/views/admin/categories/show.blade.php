@extends('layouts.postLayout')

@section('content')
    <div class="container" style="height: 100vh">
        <div class="row w-100 h-100 justify-content-center align-items-center">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title bg-dark text-white">{{ $category->id }}</h2>
                        <h2 class="card-title bg-success">{{ $category->name }}</h2>
                        <div class="card-title">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark text-white">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
