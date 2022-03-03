@extends('layouts.postLayout')

@section('content')
    <main>
        <div class="container mb-3 mt-3">
            <div class="row">
                <form action="{{ route('admin.categories.update', $category) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $category->name) }}">

                        @error('name')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="submit" class="btn btn-warning"><a class="text-decoration-none text-dark"
                            href="{{ route('admin.categories.index') }}">Back</a></button>
                </form>
            </div>
        </div>
    </main>
@endsection
