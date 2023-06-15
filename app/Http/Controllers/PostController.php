<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $getcategory = DB::select("select case when exists(select * from tb_pages where slug = ?) then 'pages'
        when exists(select * from tb_post_category where slug = ?) then 'category' end tipe",[$category,$category]);
        $posts = new Post;
        $post = $posts->getPost($category,$post);
        return view('post_detail', compact('post','getcategory'));
    }

    public function getPostByCategory($category)
    {
        $category = PostCategory::where('slug',$category)->first();
        if($category){
            $post = new Post;
            $posts = $post->getAllByCategory($category->slug,'pages');
            return view('post_category', compact('posts','category'));
        }
    }
}
