@extends('layouts.postLayout')

@section('content')
    <main>
        <div class="container mt-3 mb-3">
            <div class="row mt-3">
                <form action="{{ route('admin.posts.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <select class="form-select form-select-lg mb-3" name="category_id">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach 
                        </select>

                        @error('category_id')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">

                        @error('title')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <input type="text" class="form-control" id="content" name="content">
                        @error('content')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="submit" class="btn btn-warning"><a class="text-decoration-none text-dark"
                            href="{{ route('admin.posts.index') }}">Posts</a></button>
                </form>
            </div>
        </div>
    </main>
@endsection
