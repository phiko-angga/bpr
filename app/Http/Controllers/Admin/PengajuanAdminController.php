<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Redirect;
use Log;

class PengajuanAdminController extends Controller
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
            $pengajuan = Pengajuan::where('nama', 'like', '%'.$search.'%')
            ->orWhere('alamat', 'like', '%'.$search.'%')->paginate(10);;
        }else
            $pengajuan = Pengajuan::paginate(10);

        return view('admin.pengajuan.list', compact('pengajuan','search'));
    }
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengajuan = Pengajuan::find($id);
        $action = 'update';
        return view('admin.pengajuan.form',compact('pengajuan','action'));
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
       
        // $pengajuan = Pengajuan::find($request->id);
        // if($pengajuan){

        //     if($request->has('read')){
        //         DB::beginTransaction();
        //         try {
        //             $data = $request->only(['read']);
        //             $pengajuan = Pengajuan::where('id',$pengajuan->id)->update($data);
                    
        //             DB::commit();

        //             return redirect('/adminpanel/pengajuan')->with('info', 'Page berhasil di update');
                    
        //         } catch (\Exception $e) {
        //             DB::rollback();
        //             Log::Error($e->getMessage());
        //             return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Page gagal, silahkan coba kembali.']);
        //             // something went wrong
        //         }
        //     }
        // }else{
        //     return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data Page tidak ditemukan.']);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $page = Pengajuan::find($id);
        // $category = PostCategory::where('pengajuan_id',$id)->get();
        // if($page && $category->count() <= 0){
        //     Pengajuan::where('id',$page->id)->delete();
        //     return redirect('/adminpanel/pengajuan')->with('info', 'Page berhasil di delete.');
        // }else{
        //     return Redirect::back()->withErrors(['error'=> 'Data Page tidak ditemukan atau sedang dipakai.']);
        // }
    }
}
