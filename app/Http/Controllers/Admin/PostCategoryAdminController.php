<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostCategoryPages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\ImageHelper;
use Redirect;
use Log;

class PostCategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $search = $request->get('search');
        if(isset($search)){
            $category = PostCategory::where('name', 'like', '%'.$search.'%')->paginate(10);
        }else
            $category = PostCategory::paginate(10);

        return view('admin.postcategory.list', compact('category','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'store';
        $pages = Pages::all();
        return view('admin.postcategory.form',compact('action','pages'));
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
            'name'   => 'required',
            'slug'   => 'required',
            'file'   => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name','slug']);
            $user = auth()->user()->id;
            $data['created_by'] = $user;
            $data['status'] = $request->submit;

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageHelper = new ImageHelper();
                $name = $imageHelper->store_image($image,['dest_path' => 'img/pages-banner']);
                $data['image'] = $name;
            }

            $category = PostCategory::create($data);
            
            // Update tb_postcategory_pages
            if(isset($request->page_id)){
                $pageId = $request->page_id;
                $page_list = [];
                foreach($pageId as $page) {
                    $page_list[] = [
                        'postcategory_id' => $category->id,
                        'page_id' => $page,
                    ];
                }
                PostCategoryPages::insert($page_list);
            }

            DB::commit();

            return redirect('/adminpanel/post-category')->with('info', 'Category Post berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah Category Post gagal, silahkan coba kembali.']);
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
        $category = PostCategory::with('pages')->find($id);
        $action = 'update';
        $pages = Pages::all();
        return view('admin.postcategory.form',compact('category','action','pages'));
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
            'name'   => 'required',
            'slug'   => 'required',
        ]);

        $category = PostCategory::find($request->id);
        if($category){

            DB::beginTransaction();
            try {
                $data = $request->only(['name','slug']);
                $data['status'] = $request->submit;

                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $imageHelper = new ImageHelper();
                    $name = $imageHelper->store_image($image,['dest_path' => 'img/pages-banner']);
                    $data['image'] = $name;
                }

                $update = PostCategory::where('id',$category->id)->update($data);
                
                // Update tb_post_pages
                PostCategoryPages::where('postcategory_id',$category->id)->delete();
                if(isset($request->page_id)){
                    $pageId = $request->page_id;
                    $page_list = [];
                    foreach($pageId as $page) {
                        $page_list[] = [
                            'postcategory_id' => $category->id,
                            'page_id' => $page,
                        ];
                    }
                    PostCategoryPages::insert($page_list);
                }
                
                DB::commit();

                return redirect('/adminpanel/post-category')->with('info', 'Category Post berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Category Post gagal, silahkan coba kembali.']);
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
        $category = PostCategory::find($id);
        $post = Post::where('post_category_id',$id)->get();
        if($category && $post->count() <= 0){
            PostCategory::where('id',$category->id)->delete();
            return redirect('/adminpanel/post-category')->with('info', 'Category Post berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data Category Post tidak ditemukan atau telah dipakai post.']);
        }
    }
}
