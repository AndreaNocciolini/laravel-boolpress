<header class="row p-4 bg-primary d-flex align-items-center justify-content-around">
    <div class="col-7 d-flex align-items-center justify-content-around">
        <h1>POSTS HEADER</h1>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-success">My Posts</a>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-warning">Add New Post</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-dark text-white">Categories</a>
        <a href="{{ route('admin.home') }}" class="btn btn-info">Home</a>
    </div>
    
    {{-- @if (Route::has('login'))
        <div class="col-3 d-flex flex-row-reverse top-right links">
            @auth
                <a class="text-decoration-none text-white" href="{{ route('admin.home') }}">Home</a>
            @else
                <a class="text-decoration-none text-white" href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a class="text-decoration-none text-white" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}
</header>
