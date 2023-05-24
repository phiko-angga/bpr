<?php

namespace App\Http\Controllers;

use App\Models\KreditProduk;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class SimulasiKreditController extends Controller
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
    public function kalkulasi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required|exists:tb_kredit_produk",
            "bunga" => "required|numeric",
            "plafond_kredit" => "required|numeric",
            "jangka_waktu" => "required|numeric",
        ]);
        if ($validator->fails()) {
            $data['status'] = 'invalid';
            $data['message'] = $validator->errors()->first();
            return response()->json($data, 201);

        }else{

            $produk     = KreditProduk::find($request->id);
            $bunga      = $request->bunga;
            $bungaPerBulan  = $bunga / 12;
            $plafond_kredit = $request->plafond_kredit;
            $jangka_waktu   = $request->jangka_waktu;
            $pokok  = $plafond_kredit / $jangka_waktu;

            $data = view('part.kredit_simulator_result',compact('jangka_waktu','bunga','produk','plafond_kredit','bungaPerBulan','pokok'))->render();
            
            return response()->json(["status" => 1, "message" => "Kalkulasi", "data" => $data,"token" => csrf_token()], 201);

        }
    }
}
