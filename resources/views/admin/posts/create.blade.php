@extends('layouts.postLayout')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <form action="{{ route('admin.posts.store') }}" method="post">
                @csrf
                @method('POST')
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
                <button type="submit" class="btn btn-warning"><a class="text-decoration-none text-dark" href="{{ route('admin.posts.index') }}">Posts</a></button>
            </form>
        </div>
    </div>
</main>    
@endsection