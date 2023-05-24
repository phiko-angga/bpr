<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BeritaController extends Controller
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
    public function index()
    {
        $posts_publish = Post::with('category')->where('status','=','publish')->where('jenis_post','=','post')->orderBy('date_publish','desc')->get();
        return view('berita',compact('posts_publish'));
    }
}
