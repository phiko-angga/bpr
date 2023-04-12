<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeBanner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\ImageHelper;
use Redirect;
use Log;

class HomeBannerAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner = HomeBanner::paginate(10);
        return view('admin.homebanner.list', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'store';
        $total_banner = HomeBanner::count();
        return view('admin.homebanner.form',compact('action','total_banner'));
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
            'file'   => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['description','order']);
            $user = auth()->user()->id;
            $data['created_by'] = $user;
            $data['status'] = $request->submit;

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageHelper = new ImageHelper();
                $name = $imageHelper->store_image($image,['dest_path' => 'img/banner']);
                $data['image'] = $name;
            }
            $banner = HomeBanner::create($data);

            DB::commit();

            return redirect('/adminpanel/home-banner')->with('info', 'Banner berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah Banner gagal, silahkan coba kembali.']);
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
        $banner = HomeBanner::find($id);
        $action = 'update';
        
        // dd(array_column($banner->pages->toArray(),'page_id'));
        return view('admin.homebanner.form',compact('banner','action'));
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
        ]);

        $banner = HomeBanner::find($request->id);
        if($banner){

            DB::beginTransaction();
            try {
                $data = $request->only(['description','order']);
                $data['status'] = $request->submit;

                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $imageHelper = new ImageHelper;
                    $name = $imageHelper->store_image($image,['dest_path' => 'banner']);
                    $data['image'] = $name;
                }
                HomeBanner::where('id',$banner->id)->update($data);

                DB::commit();

                return redirect('/adminpanel/home-banner')->with('info', 'Banner berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Banner gagal, silahkan coba kembali.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data Banner tidak ditemukan.']);
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
        $banner = HomeBanner::find($id);
        if($banner){
            HomeBanner::where('id',$banner->id)->delete();
            return redirect('/adminpanel/home-banner')->with('info', 'Banner berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data Banner tidak ditemukan.']);
        }
    }
}
