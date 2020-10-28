<?php

namespace App\Http\Controllers\Home;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(12);

        return view('pages.home.post.index', compact('posts'));
    }
    
    public function show($id)
    {
        $post = Post::findOrFail($id);
        // $post = Post::where('slug', $slug)->getFirst();
        
        return view('pages.home.post.show',compact('post'));
    }
}
