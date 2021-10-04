<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id = null)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts()->get();
        return view('blog.index', [
            'posts' => $posts]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create', [
            'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        $newImageName = uniqid() . '-' . $request->title
            . '-' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        $slug = SlugService::createSlug(
            Post::class,
            'slug',
            $request->title
        );
        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'image' => $newImageName,
            'isPublished' => false,
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->user()->id
                ]);
        return redirect('/blog')->with('message', 'Your post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')
        ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();
        return view('blog.edit', [
            'categories' => $categories])
        ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        Post::where('slug', $slug)
        ->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'isPublished' => false,
            'category_id' => $request->input('category_id')
        ]);
        return redirect('/blog')->with('message', 'Your post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();
        return redirect('/blog')->with('message', 'Your post has been deleted');
    }
}
