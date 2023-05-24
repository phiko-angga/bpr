<?php

namespace App\Helpers;
use App\Models\KreditProduk;

Class SidebarHelper {

    public function show($sidebar){
        $data = [];
        if($sidebar == 'kredit_simulator'){
            $data['produk'] = KreditProduk::all();
        }

        return view('sidebar.'.$sidebar, $data);
    }

    // private function kredit_simulator(){
    //     $produk = KreditProduk::all();
    //     return view('sidebar.kredit_simulator', compact('produk'));
    // }
}