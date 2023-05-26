<?php

namespace App\Helpers;
use App\Models\KreditProduk;

Class SidebarHelper {

    public function show($sidebar){
        $data = [];
        if($sidebar == 'kredit_simulator'){
            $data['produk'] = KreditProduk::all();
        }
        if(\View::exists('sidebar.'.$sidebar))
            return view('sidebar.'.$sidebar, $data);
        else
            return false;
    }
}