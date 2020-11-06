<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
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
        $categories = Category::all();
        return view('pages.dashboard.post.create',
            compact('categories')
        );
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
            'category_id' => 'required',
            'image' => 'nullable'
        ]);
        $post['slug'] = Str::slug(request('title'));
        $post['image'] = $image;

        //create
        Post::create($post);
        session()->flash('success-add', 'Data berhasil ditambahkan');

        
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
    {
        $posts = Post::where('slug', $slug)->get();
        // $category = $posts->posts->name;
        // $post = Post::findOrFail($slug);
        
        return view('pages.dashboard.post.show', compact('posts'));
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
        $categories = Category::all();
        
        return view('pages.dashboard.post.edit', compact(
            'post',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, PostRequest $request)
    {

        /**
         * Use (Request $request, and $id) as parameters
         *  using commont method
         */

        // $newPost = $request->validate([
        //     'title' => 'required',
        //     'body' => 'required',
        //     'image' => 'nullable'
        // ]);

        // $post = Post::find($id);
        
        // if($request->file('image')){
        //     if($post->image){
        //         Storage::delete($post->image);
        //     }
        //     $newPost['image'] = $request->file('image')->store('public');
        // }        
        // // $post->update([
        // //     'title' => $request->title,
        // //     'body' => $request->body,
        // //     'image' => $image
        // // ]);

        // $post->update($newPost);

        // return redirect()->route('post.index');


        /**
         * Use (Post $post) as a parameter
         */

        // $input = request()->validate([
        //     'title' => 'required',
        //     'body' => 'required',
        //     'image' => 'nullable'
        // ]);
        
        // if(request()->file('image')){
        //     if($post->image){
        //         Storage::delete($post->image);
        //     }
        //     $input['image'] = request()->file('image')->store('public');
        // }

        // $post->update($input);
        // return redirect()->route('post.index');


        /**
         * Use (PostRequest $request, Post $post)
         */


        $atr = $request->all();
        if($request->file('image')){
            if($post->image){
                Storage::delete($post->image);
            }
            $atr['image'] = $request->file('image')->store('public');
        }

        $post->update($atr);
        session()->flash('success-edit', 'Data berhasil diubah');
        
        return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }
        $post->delete();

        return redirect()->route('post.index');
    }

}
