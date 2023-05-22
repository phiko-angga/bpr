<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Pages;
use App\Models\PostCategory;
use App\Models\PostPages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\ImageHelper;
use Redirect;
use Log;

class PostAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with(['createdby','category']);
        $search = $request->get('search');
        if(isset($search)){
            $posts = $posts->where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%');
        }
        $posts = $posts->paginate(10);
        return view('admin.post.list', compact('posts','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = PostCategory::all();
        $pages = Pages::all();
        $action = 'store';
        return view('admin.post.form',compact('category','pages','action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        request()->validate([
            'title'   => 'required',
            'slug'   => 'required',
            'description'   => 'required',
            'contents'   => 'required',
            'date_publish'   => 'required',
            'time_publish'   => 'required',
            'file'   => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'post_category_id'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['title','slug','description','contents','post_category_id','status']);
            $user = auth()->user()->id;
            $data['created_by'] = $user;
            $data['author'] = $user;
            $data['editor'] = $user;
            $data['status'] = $request->submit;
            $data['jenis_post'] = isset($request->asberita) ? $request->asberita : 'info';

            $date_publish = Carbon::parse($request->date_publish)->format('Y-m-d');
            $time_publish = Carbon::parse($request->time_publish)->format('H:i:s');
            $data['date_publish'] = $date_publish.' '.$time_publish;
            
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageHelper = new ImageHelper();
                $name = $imageHelper->store_image($image,['dest_path' => 'img/post']);
                $data['image'] = $name;
                $data['image_thumb'] = $name;
            }

            $post = Post::create($data);

            // Update tb_post_pages
            if(isset($request->page_id)){
                $pageId = $request->page_id;
                $page_list = [];
                foreach($pageId as $page) {
                    $page_list[] = [
                        'post_id' => $post->id,
                        'page_id' => $page,
                    ];
                }
                PostPages::insert($page_list);
            }

            DB::commit();

            return redirect('/adminpanel/post')->with('info', 'Post berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah Post gagal, silahkan coba kembali.']);
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('pages')->find($id);
        $category = PostCategory::all();
        $pages = Pages::all();
        $action = 'update';
        
        // dd(array_column($post->pages->toArray(),'page_id'));
        return view('admin.post.form',compact('post','category','pages','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'id'   => 'required',
            'title'   => 'required',
            'slug'   => 'required',
            'description'   => 'required',
            'contents'   => 'required',
            'date_publish'   => 'required',
            'time_publish'   => 'required',
            'post_category_id'   => 'required',
        ]);

        $post = Post::find($request->id);
        if($post){

            DB::beginTransaction();
            try {
                $data = $request->only(['title','slug','description','contents','post_category_id']);

                $data['jenis_post'] = isset($request->asberita) ? $request->asberita : 'info';
                $data['status'] = $request->submit;

                $date_publish = Carbon::parse($request->date_publish)->format('Y-m-d');
                $time_publish = Carbon::parse($request->time_publish)->format('H:i:s');
                $data['date_publish'] = $date_publish.' '.$time_publish;

                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $imageHelper = new ImageHelper;
                    $name = $imageHelper->store_image($image,['dest_path' => 'img/post']);
                    $data['image'] = $name;
                    $data['image_thumb'] = $name;
                }

                Post::where('id',$post->id)->update($data);

                // Update tb_post_pages
                PostPages::where('post_id',$post->id)->delete();
                if(isset($request->page_id)){
                    $pageId = $request->page_id;
                    $page_list = [];
                    foreach($pageId as $page) {
                        $page_list[] = [
                            'post_id' => $post->id,
                            'page_id' => $page,
                        ];
                    }
                    PostPages::insert($page_list);
                }
                
                DB::commit();

                return redirect('/adminpanel/post')->with('info', 'Post berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Post gagal, silahkan coba kembali.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data Post tidak ditemukan.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post){
            Post::where('id',$post->id)->delete();
            return redirect('/adminpanel/post')->with('info', 'Post berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data Post tidak ditemukan.']);
        }
    }
}
