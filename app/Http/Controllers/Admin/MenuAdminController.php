<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\ImageHelper;
use Redirect;
use Log;

class MenuAdminController extends Controller
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
            $pages = Pages::where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')->paginate(10);;
        }else
            $pages = Pages::paginate(10);

        return view('admin.pages.list', compact('pages','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'store';
        return view('admin.pages.form',compact('action'));
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
            'file'   => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['title','slug','description','contents','status','is_top']);
            $user = auth()->user()->id;
            $data['created_by'] = $user;
            $data['status'] = $request->submit;
            
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageHelper = new ImageHelper();
                $name = $imageHelper->store_image($image,['dest_path' => 'img/pages-banner']);
                $data['image'] = $name;
                $data['image_thumb'] = $name;
            }

            $page = Pages::create($data);
            
            DB::commit();

            return redirect('/adminpanel/pages')->with('info', 'Page berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah Page gagal, silahkan coba kembali.']);
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
        $page = Pages::find($id);
        $action = 'update';
        return view('admin.pages.form',compact('page','action'));
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
            'title'   => 'required',
            'slug'   => 'required',
            'description'   => 'required',
            'contents'   => 'required',
        ]);

        $page = Pages::find($request->id);
        if($page){

            DB::beginTransaction();
            try {
                $data = $request->only(['title','slug','description','contents','status','is_top']);
                $data['status'] = $request->submit;
                
                if(!$request->has('is_top'))
                    $data['is_top'] = 0;
                
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $imageHelper = new ImageHelper();
                    $name = $imageHelper->store_image($image,['dest_path' => 'img/pages-banner']);
                    $data['image'] = $name;
                    $data['image_thumb'] = $name;
                }

                $page = Pages::where('id',$page->id)->update($data);
                
                DB::commit();

                return redirect('/adminpanel/pages')->with('info', 'Page berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Page gagal, silahkan coba kembali.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data Page tidak ditemukan.']);
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
        $page = Pages::find($id);
        $category = PostCategory::where('pages_id',$id)->get();
        if($page && $category->count() <= 0){
            Pages::where('id',$page->id)->delete();
            return redirect('/adminpanel/pages')->with('info', 'Page berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data Page tidak ditemukan atau sedang dipakai.']);
        }
    }
}
