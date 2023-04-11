<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'tb_post_category';
    protected $fillable = [
        'id', 'name', 'slug', 'jenis', 'status', 'pages_id', 'order', 'created_by' 
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
 
}
