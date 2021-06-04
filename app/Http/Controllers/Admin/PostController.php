<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
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
        return view('admin.posts.index', 
        [
            'posts'=>Post::all(),
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create_edit', [
            'categories'=>Category::all(),
        ]);
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
        $data['slug'] = slug($data['title']);
        $data['user_id'] = auth()->id();

        if(Post::create($data)) {
            return redirect(route('posts.index'))->with('success', 'Notícia cadastrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.create_edit', [
            'categories'=>Category::all(),
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $this->dataValidation($request);
        $data['slug'] = slug($data['title']);
        $data['user_id'] = auth()->id();


        if($post->update($data)) {
            return redirect(route('posts.index'))->with('success', 'Notícia salva.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->delete()) {
            return redirect()->back()->with('success', 'Notícia excluída.');
        }
    }

    public function dataValidation($request)
    {
        return $request->validate([
            'title' => 'required',
            'body' => '',
            'category_id' => '',
            'resume' => ''
        ], [
            'title.required' => 'Por favor informe o titulo da notícia.'
        ]);
    }
}
