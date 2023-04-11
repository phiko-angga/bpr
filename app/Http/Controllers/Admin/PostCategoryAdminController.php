<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostCategory;
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
        return view('admin.postcategory.form',compact('action'));
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
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name','slug']);
            $user = auth()->user()->id;
            $data['created_by'] = $user;
            $data['status'] = $request->submit;

            $category = PostCategory::create($data);
            
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
        $category = PostCategory::find($id);
        $action = 'update';
        return view('admin.postcategory.form',compact('category','action'));
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

                $category = PostCategory::where('id',$category->id)->update($data);
                
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
