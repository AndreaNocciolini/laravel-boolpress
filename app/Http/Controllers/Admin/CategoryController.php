<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // $posts = Post::paginate(16);

        // Facciamo in modo che vengano visualizzati in pagina solo i posts dell'utente connesso
        $categories = Category::paginate(16);
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }
}
