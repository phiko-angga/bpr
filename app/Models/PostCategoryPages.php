<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategoryPages extends Model
{
    protected $table = 'tb_postcategory_pages';
    protected $fillable = [
        'id', 'postcategory_id', 'page_id' 
    ];
 
}
