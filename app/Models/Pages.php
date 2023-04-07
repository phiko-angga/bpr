<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'tb_pages';
    protected $fillable = [
        'id', 'title', 'slug', 'contents', 'views', 'status', 'created_by', 'image', 'image_thumb'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
    
}
