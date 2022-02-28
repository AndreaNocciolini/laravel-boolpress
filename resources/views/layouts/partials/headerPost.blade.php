<header class="row p-4 bg-primary d-flex align-items-center justify-content-around">
    <div class="col-4 d-flex align-items-center justify-content-around">
        <h1>POSTS HEADER</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-info">Add New Post</a>
    </div>
    
    @if (Route::has('login'))
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
    @endif
</header>
