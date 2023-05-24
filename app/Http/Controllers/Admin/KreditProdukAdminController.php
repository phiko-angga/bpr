<?php

namespace App\Http\Controllers\Admin;

use App\Models\KreditProduk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Redirect;
use Log;

class KreditProdukAdminController extends Controller
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
            $kreditProduk = KreditProduk::where('nama', 'like', '%'.$search.'%')->paginate(10);
        }else
            $kreditProduk = KreditProduk::paginate(10);

        return view('admin.kreditproduk.list', compact('kreditProduk','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'store';
        return view('admin.kreditproduk.form',compact('action'));
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
            'nama'   => 'required',
            'bunga'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['nama','bunga']);
            $user = auth()->user()->id;
            $data['created_by'] = $user;
            $data['status'] = $request->submit;

            $kreditProduk = KreditProduk::create($data);
            
            DB::commit();

            return redirect('/adminpanel/produk-kredit')->with('info', 'Produk kredit berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah Produk kredit gagal, silahkan coba kembali.']);
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
        $kreditProduk = KreditProduk::find($id);
        $action = 'update';
        return view('admin.kreditproduk.form',compact('kreditProduk','action'));
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
            'nama'   => 'required',
            'bunga'   => 'required',
        ]);

        $kreditProduk = KreditProduk::find($request->id);
        if($kreditProduk){

            DB::beginTransaction();
            try {
                $data = $request->only(['nama','bunga']);

                $kreditProduk = KreditProduk::where('id',$kreditProduk->id)->update($data);
                
                DB::commit();

                return redirect('/adminpanel/produk-kredit')->with('info', 'Produk kredit berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update Produk kredit gagal, silahkan coba kembali.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data tidak ditemukan.']);
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
        $kreditProduk = KreditProduk::find($id);
        if($kreditProduk){
            KreditProduk::where('id',$kreditProduk->id)->delete();
            return redirect('/adminpanel/produk-kredit')->with('info', 'Produk kredit berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data Produk kredit tidak ditemukan atau telah dipakai post.']);
        }
    }
}
