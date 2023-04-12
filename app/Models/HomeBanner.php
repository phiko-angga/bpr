<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    protected $table = 'tb_home_banner';
    protected $fillable = [
        'id', 'image', 'status', 'description', 'order', 'created_by' 
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
 
}
