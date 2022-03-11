<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);

        return response()->json([
            'response' => true,
            'result' => $posts,
        ]);
    }

    public function randomPosts()
    {
        $posts = Post::inRandomOrder()->limit(12)->get();

        return response()->json([
            'response' => true,
            'result' => $posts,
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'response' => true,
            'count' => $post ? 1 : 0,
            'result' =>  [
                'data' => $post
            ],
        ]);
    }
}
