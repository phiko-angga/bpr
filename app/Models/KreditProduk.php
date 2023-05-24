<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KreditProduk extends Model
{
    protected $table = 'tb_kredit_produk';
    protected $fillable = [
        'id', 'nama', 'bunga' 
    ];
 
}
