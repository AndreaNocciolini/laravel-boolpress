<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;
use App\Http\Controllers\Controller;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::paginate(16);

        // Facciamo in modo che vengano visualizzati in pagina solo i posts dell'utente connesso
        $posts = Post::where('user_id', Auth::user()->id)->paginate(12);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:App\Model\Category,id',
            'tags.*' => 'nullable|exists:App\Model\Tag,id',
            'image' => 'nullable|image',
        ]);
        
        $data = $request->all();
        $slug = Str::slug($data['title'], '-');

        //Questo controllo serve a fare in modo che non esistano "slug" identici tra loro.
        //Nel caso in cui $postSlugControl non sia null (la ricerca qua sotto cerca il primo risultato con quello "slug"), si entra nel While.
        
        $postSlugControl = Post::where('slug', $slug)->first();

        //Partendo da zero, se trova un altro "slug" identico a quello che sta creando, aggiunger?? un numero in base al counter.
        //Quindi, nel caso ne avessimo due uguali, lo "slug" dell'elemento che stiamo creando sar?? qualcosa del tipo "slugesempio-1", se ne avessimo 50 uguali sar?? "slugesempio-50"(quelli prima partiranno da slugesempio fino a slugesempio49).
        $counter = 0;
        while ($postSlugControl) {
            $newSlug = $slug . '-' . $counter;
            $postSlugControl = Post::where('slug', $newSlug)->first();
            $counter++;
        }

        if (!empty($data["image"])) {
            $img_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $img_path;
        }

        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->image = $data['image'];
        $post->category_id = $data['category_id'];
        $post->user_id = Auth::user()->id;
        if ($postSlugControl) {
            $post->slug = $newSlug;
        } else {
            $post->slug = $slug;
        }


        $save = $post->save();

        if (!$save) {
            dd('Save failed...');
        }

        if (!empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags'=> $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:App\Model\Category,id',
            'tags.*' => 'nullable|exists:App\Model\Tag,id',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        $post->title = $data['title'];
        $post->content = $data['content'];

        if ($post->title != $data['title']) {
            $post->title = $data['title'];

            $slug = Str::slug($data['title'], '-');
            $postSlugControl = Post::where('slug', $slug)->first();

            $counter = 0;
            while ($postSlugControl) {
                $newSlug = $slug . '-' . $counter;
                $postSlugControl = Post::where('slug', $newSlug)->first();
                $counter++;
            }

            if ($postSlugControl) {
                $post->slug = $newSlug;
            } else {
                $post->slug = $slug;
            }
        }
        
        if (!empty($data["image"])) {
            $img_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $img_path;
        }

        $post->image =  $data["image"];
        $post->category_id = $data['category_id'];
        $post->user_id = Auth::user()->id;

        $updated = $post->update();

        if (!$updated) {
            dd('Update failed...');
        }

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', "The post '$post->title' was deleted!");
    }
}
