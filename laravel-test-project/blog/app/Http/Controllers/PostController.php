<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{

    public function __construct(){
        //$this->middleware('auth')->except('index');
        //$this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('posts.index',[
            'users' => User::all(),
            'categories' => Category::all(),
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!Auth::check()){
        //     return redirect('posts');
        // }
        return view('posts.create',[
            'categories' => Category::all(),
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
        // if(!Gate::allows('user-can-create')){
        //     abort(403);
        // }
        $validated = $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'text' => 'required',
                'categories' => 'nullable|array',
                'categories.*' => 'numeric|integer|exists:categories,id',
                'cover_image' => 'file|mimes:jpg,png|max:1024'
            ],
            [
                'required' => 'A mező megadása kötelező',
                'style.required' => 'Dehát a style az required!'
            ]
        );
        $cover_image_path = '';
        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            $cover_image_path = 'cover_image_'.Str::random(16).'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($cover_image_path,$file->get());
        }
        $post = Post::factory()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'text' => $validated['text'],
            'cover_image_path' => $cover_image_path,
            'author_id' => Auth::id(),
        ]);
        isset($validated['categories']) ? 
        $post->categories()->sync($validated['categories']) : "";
        Session::flash('post_created',$validated['title']);
        // Session::flash('name',$validated['name']);
        // Session::flash('style',$validated['style']);
        return redirect()->route('posts.show',$post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',[
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update',$post);
        $validated = $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'text' => 'required',
                'categories' => 'nullable|array',
                'categories.*' => 'numeric|integer|exists:categories,id',
                'cover_image' => 'file|mimes:jpg,png|max:1024',
                'remove_cover_path' => 'nullable|boolean'
            ],
            [
                'required' => 'A mező megadása kötelező',
                'style.required' => 'Dehát a style az required!'
            ]
        );
        $cover_image_path = $post->cover_image_path;
        if(isset($validated['remove_cover_path'])){
            $cover_image_path = "";
        }
        elseif($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            $cover_image_path = 'cover_image_'.Str::random(16).'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($cover_image_path,$file->get());
            Storage::disk('public')->delete($post->cover_image_path);
        }
        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->text = $validated['text'];
        $post->cover_image_path = $cover_image_path;
        $post->save();

        isset($validated['categories']) ? 
        $post->categories()->sync($validated['categories']) : "";
        Session::flash('post_edited',$validated['title']);
        // Session::flash('name',$validated['name']);
        // Session::flash('style',$validated['style']);
        return redirect()->route('posts.show',$post);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
