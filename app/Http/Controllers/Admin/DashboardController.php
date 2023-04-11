<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
        $post = Post::count();
        $page = Pages::count();
        $pageVisitor = Pages::selectRaw('sum(views) views')->first();
        $postVisitor = Post::selectRaw('sum(views) views')->first();
        $views = $pageVisitor->views + $postVisitor->views;
        return view('admin.dashboard',compact('post','page','views'));
    }
}
