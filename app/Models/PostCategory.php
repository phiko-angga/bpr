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
 
    public function getAllByPages($page){
        $data = Self::select('tb_post_category.*')
        ->join('tb_postcategory_pages as pp','pp.postcategory_id','=','tb_post_category.id')
        ->join('tb_pages as p','p.id','=','pp.page_id')
        ->where('p.slug',$page)
        ->orderBy('tb_post_category.id','desc')
        ->get();
    
        return $data;
    }
}
