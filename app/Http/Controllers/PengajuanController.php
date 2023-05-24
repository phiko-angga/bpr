<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class PengajuanController extends Controller
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
    public function submitPengajuan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "nama" => "required",
            "alamat" => "required",
            "telp" => "required",
            "pesan" => "required",
        ]);
        if ($validator->fails()) {
            $data['status'] = 'invalid';
            $data['message'] = $validator->errors()->first();
            return response()->json($data, 422);

        }else{

            $pengajuan = Pengajuan::create($request->only(['nama','alamat','telp','email','pesan']));
            
            return response()->json(["status" => 1, "message" => "Pengajuan telah diterima."], 201);

        }

        
        
    }
}
