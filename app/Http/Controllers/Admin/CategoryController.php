<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = NULL;

        if(request('cat') AND !empty(request('cat'))) {
            $cat = Category::findOrFail(request('cat'));
        }
        return view('admin.categories.index', 
        [
            'categories'=>Category::all(),
            'cat' => $cat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->dataValidation($request);
        $data['slug'] = slug($data['name']);
        $data['user_id'] = auth()->id();

        if(Category::create($data)) {
            return redirect()->back()->with('success', 'Categoria cadastrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $this->dataValidation($request);
        $data['slug'] = slug($data['name']);
        $data['user_id'] = auth()->id();

        if($category->update($data)) {
            return redirect(route('categories.index'))->with('success', 'Categoria salva.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()) {
            return redirect()->back()->with('success', 'Categoria excluída.');
        }
    }

    public function dataValidation($request)
    {
        return $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Por favor informe o nome da categoria.'
        ]);
    }
}
