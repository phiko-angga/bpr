<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'tb_pengajuan';
    protected $fillable = [
        'id', 'nama', 'alamat', 'telp', 'email', 'read', 'pesan'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
    
}
