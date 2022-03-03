@extends('layouts.postLayout')

@section('content')
    <main>
        <div class="container mt-3 mb-3">
            <div class="row mt-3">
                <form action="{{ route('admin.categories.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                        @error('name')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a type="submit" class="btn btn-info text-decoration-none text-dark"
                        href="{{ route('admin.categories.index') }}">Back</a>
                </form>
            </div>
        </div>
    </main>
@endsection
