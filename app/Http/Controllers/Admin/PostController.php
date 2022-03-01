<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(16);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
        ]);

        $data = $request->all();
        $slug = Str::slug($data['title'], '-');

        //Questo controllo serve a fare in modo che non esistano "slug" identici tra loro.
        //Nel caso in cui $postSlugControl non sia null (la ricerca qua sotto cerca il primo risultato con quello "slug"), si entra nel While.

        $postSlugControl = Post::where('slug', $slug)->first();

        //Partendo da zero, se trova un altro "slug" identico a quello che sta creando, aggiungerà un numero in base al counter.
        //Quindi, nel caso ne avessimo due uguali, lo "slug" dell'elemento che stiamo creando sarà qualcosa del tipo "slugesempio-1", se ne avessimo 50 uguali sarà "slugesempio-50"(quelli prima partiranno da slugesempio fino a slugesempio49).
        $counter = 0;
        while ($postSlugControl) {
            $newSlug = $slug . '-' . $counter;
            $postSlugControl = Post::where('slug', $newSlug)->first();
            $counter++;
        }

        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        if ($postSlugControl) {
            $post->slug = $newSlug;
        } else {
            $post->slug = $slug;
        }


        $save = $post->save();

        if (!$save) {
            dd('Save failed...');
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
        return view('admin.posts.edit', ['post' => $post]);
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
        ]);

        $data = $request->all();

        $post->title = $data['title'];
        $post->content = $data['content'];
        $updated = $post->update();

        if (!$updated) {
            dd('Update failed...');
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
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', "The post '$post->title' was deleted!");
    }
}
