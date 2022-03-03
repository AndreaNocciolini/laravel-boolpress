<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(16);
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $slug = Str::slug($data['name'], '-');

        //Questo controllo serve a fare in modo che non esistano "slug" identici tra loro.
        //Nel caso in cui $categorySlugControl non sia null (la ricerca qua sotto cerca il primo risultato con quello "slug"), si entra nel While.

        $categorySlugControl = Category::where('slug', $slug)->first();

        //Partendo da zero, se trova un altro "slug" identico a quello che sta creando, aggiungerà un numero in base al counter.
        //Quindi, nel caso ne avessimo due uguali, lo "slug" dell'elemento che stiamo creando sarà qualcosa del tipo "slugesempio-1", se ne avessimo 50 uguali sarà "slugesempio-50"(quelli prima partiranno da slugesempio fino a slugesempio49).
        $counter = 0;
        while ($categorySlugControl) {
            $newSlug = $slug . '-' . $counter;
            $categorySlugControl = Category::where('slug', $newSlug)->first();
            $counter++;
        }

        $category = new Category();
        $category->name = $data['name'];
        if ($categorySlugControl) {
            $category->slug = $newSlug;
        } else {
            $category->slug = $slug;
        }


        $save = $category->save();

        if (!$save) {
            dd('Save failed...');
        }

        return redirect()->route('admin.categories.show', $category->id);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category'=>$category]);
    }

    public function update(Request $request, Category $category)
    {
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $slug = Str::slug($data['name'], '-');

        //Questo controllo serve a fare in modo che non esistano "slug" identici tra loro.
        //Nel caso in cui $categorySlugControl non sia null (la ricerca qua sotto cerca il primo risultato con quello "slug"), si entra nel While.

        $categorySlugControl = Category::where('slug', $slug)->first();

        //Partendo da zero, se trova un altro "slug" identico a quello che sta creando, aggiungerà un numero in base al counter.
        //Quindi, nel caso ne avessimo due uguali, lo "slug" dell'elemento che stiamo creando sarà qualcosa del tipo "slugesempio-1", se ne avessimo 50 uguali sarà "slugesempio-50"(quelli prima partiranno da slugesempio fino a slugesempio49).
        $counter = 0;
        while ($categorySlugControl) {
            $newSlug = $slug . '-' . $counter;
            $categorySlugControl = Category::where('slug', $newSlug)->first();
            $counter++;
        }

        $category->name = $data['name'];
        if ($categorySlugControl) {
            $category->slug = $newSlug;
        } else {
            $category->slug = $slug;
        }


        $save = $category->update();

        if (!$save) {
            dd('Update failed...');
        }

        return redirect()->route('admin.categories.show', $category->id);
    }
}
