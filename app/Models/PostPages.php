<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPages extends Model
{
    protected $table = 'tb_post_pages';
    protected $fillable = [
        'id', 'post_id', 'page_id' 
    ];
 
}
