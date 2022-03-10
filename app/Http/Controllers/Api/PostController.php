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
            'response'=>true,
            'result'=>$posts,
        ]);
    }
}
