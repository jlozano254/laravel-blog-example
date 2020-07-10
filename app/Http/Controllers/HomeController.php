<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the authenticated user posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->paginate(Post::TAKE);
        return view('home', compact('posts'));
    }
}
