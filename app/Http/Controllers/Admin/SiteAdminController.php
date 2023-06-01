<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\ImageHelper;
use Redirect;
use Log;

class SiteAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $site = Site::first();
        return view('admin.site.list', compact('site'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function save(Request $request)
    {
        request()->validate([
            'nama'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['nama','deskripsi','deskripsi_footer','alamat','telp','no_hp','no_wa','email','twitter','instagram','fb',
                                    'youtube','maps','longitude','latitude']);
                                    
            if ($request->hasFile('logo_header')) {
                $image = $request->file('logo_header');
                $imageHelper = new ImageHelper();
                $name1 = $imageHelper->store_image($image,['dest_path' => 'img']);
                $data['logo_header'] = $name1;
            }
            if ($request->hasFile('logo_footer')) {
                $image2 = $request->file('logo_footer');
                $imageHelper2 = new ImageHelper();
                $name2 = $imageHelper2->store_image($image2,['dest_path' => 'img']);
                $data['logo_footer'] = $name2;
            }
            if ($request->hasFile('logo_favicon')) {
                $image3 = $request->file('logo_favicon');
                $imageHelper3 = new ImageHelper();
                $name3 = $imageHelper3->store_image($image3,['dest_path' => 'img']);
                $data['logo_favicon'] = $name3;
            }

            $page = Site::updateOrCreate(["id" => $request->id],$data);
            
            DB::commit();

            return redirect('/adminpanel/site')->with('info', 'Site berhasil diperbarui');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Simpan site gagal, silahkan coba kembali.']);
            // something went wrong
        }
    }

}
