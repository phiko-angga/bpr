<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'tb_site';
    protected $fillable = [
        'nama', 'deskripsi', 'deskripsi_footer', 'alamat', 'telp', 'no_hp', 'no_wa', 'email', 'twitter', 
        'instagram','fb','youtube','longitude','latitude','maps','logo_header','logo_footer','logo_favicon','wa_text','wa_telp'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
    
}
