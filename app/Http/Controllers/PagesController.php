<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Post;
use App\Helpers\SidebarHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
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
    public function index($pages)
    {
        $page = Pages::where('slug',$pages)->first();
        if($page){
            return view('pages', compact('page'));
        }else{
            Redirect::to(url('page-not-found'));
        }
    }
}
