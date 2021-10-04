<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
  
    public function index()
    {
        $posts = Post::paginate(5);
        return view('home', [
            'posts' => $posts]);
    }
}
