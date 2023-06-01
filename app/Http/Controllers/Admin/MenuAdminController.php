<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
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
        $menu = Menu::where('status','public');
        if(isset($search)){
            $menu = $menu->where(function($query) use ($starttime,$endtime){
                $query->where('name', 'like', '%'.$search.'%');
                $query->orWhere('link', 'like', '%'.$search.'%');
            })->paginate(10);
        }else
            $menu = $menu->paginate(10);

        return view('admin.menu.list', compact('menu','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'store';
        $pages = new Pages();
        $page_list = $pages->pagesNotInMenu();
        return view('admin.menu.form',compact('action','page_list'));
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
            'link'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['page_id','name','link']);
            
            $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
            $data['order'] = $request->has('order') ? $request->is_active : 0;
            $data['status'] = 'public';
            $data['keterangan'] = '';
            $menu = Menu::create($data);
            
            DB::commit();

            return redirect('/adminpanel/menu')->with('info', 'Menu berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah Menu gagal, silahkan coba kembali.']);
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
        $menu = Menu::select('tb_menu.*')->selectRaw('ifnull(p.id,"") page_id2')->selectRaw('ifnull(p.title,"") page_name')
        ->leftJoin('tb_pages as p','p.id','=','tb_menu.page_id')->where('tb_menu.id',$id)->first();
        $action = 'update';
        $pages = new Pages();
        $page_list = $pages->pagesNotInMenu();
        return view('admin.menu.form',compact('menu','page_list','action'));
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
            'link'   => 'required',
            'name'   => 'required',
        ]);

        $menu = Menu::find($request->id);
        if($menu){

            DB::beginTransaction();
            try {
                $data = $request->only(['page_id','name','link']);
                
                $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
                $data['order'] = $request->has('order') ? $request->is_active : 0;
                
                $menu = Menu::where('id',$menu->id)->update($data);
                DB::commit();

                return redirect('/adminpanel/menu')->with('info', 'Menu berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Menu gagal, silahkan coba kembali.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data Menu tidak ditemukan.']);
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
        $menu = Menu::find($id);
        if($menu){
            Menu::where('id',$menu->id)->delete();
            return redirect('/adminpanel/menu')->with('info', 'Menu berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data Menu tidak ditemukan atau sedang dipakai.']);
        }
    }
}
