@extends('layouts.postLayout')

@section('content')
    <main>
        <div class="container mb-3 mt-3">
            <div class="row">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select form-select-lg mb-3" name="category_id">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option @if ($post->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>
                    <fieldset class="mb-3">
                        <label>Tags</label>
                        @if ($errors->any())
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                        name="tags[]" {{ $post->tags()->get()->contains($tag->id)? 'checked': '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </fieldset>
                    @error('tags.*')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $post->title) }}">

                        @error('title')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <input type="text" class="form-control" id="content" name="content"
                            value="{{ old('content', $post->content) }}">
                        @error('content')
                            <div class="alert alert-danger">This field is required.</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="submit" class="btn btn-warning"><a class="text-decoration-none text-dark"
                            href="{{ route('admin.posts.index') }}">Back</a></button>
                </form>
            </div>
        </div>
    </main>
@endsection
