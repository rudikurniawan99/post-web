<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('pages.dashboard.post.index', compact('posts'));

        // DataTables Failed
        // if($request->ajax()){
        //     return DataTables::of($posts)
        //         ->addIndexColumn()
        //         ->make(true);
        // }
        // return view('pages.dashboard.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        // if(!$request->file('image')){

        //     $this->validate($request, [
        //         'title' => 'required',
        //         'body' => 'required',
        //         'image' => 'nullable'
        //     ]);

        //     Post::create([
        //         'title' => $request->title,
        //         'body' => $request->body,
        //         'slug' => Str::slug($request->title),
        // ]);
        // }else{
        //     $image = $request->file('image')->store('public');
        //     Post::create([
        //         'title' => $request->title,
        //         'body' => $request->body,
        //         'image' => $image,
        //         'slug' => Str::slug($request->title)
        //     ]);
        // }
        $image= request('image');
        if($image){
            $image = request()->file('image')->store('public');
        }

        // validation
        $post = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable'
        ]);
        $post['slug'] = Str::slug(request('title'));
        $post['image'] = $image;

        //create
        Post::create($post);

        
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts = Post::where('slug', $slug)->get();
        $post = Post::findOrFail($id);
        
        return view('pages.dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        return view('pages.dashboard.post.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $image = $request->file('image')->store('public');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
