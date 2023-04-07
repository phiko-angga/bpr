<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($category, $post)
    {
        $posts = new Post;
        $post = $posts->getPost($category,$post);
        return view('post_detail', compact('post'));
    }
}
