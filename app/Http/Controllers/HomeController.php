<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();

        if(request('query')) {
            $searchString = request('query');

            $cats = Category::where('name', 'like', '%'.$searchString.'%')->get('id');

            $posts = Post::whereIn('category_id', $cats)
            ->orWhere('title', 'like', '%'.$searchString.'%')
            ->orWhere('body', 'like', '%'.$searchString.'%')
            ->orWhere('resume', 'like', '%'.$searchString.'%')->get();
        }
        return view('home', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post', compact('post'));
    }
}
