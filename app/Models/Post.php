<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class Post extends Model
{
    protected $table = 'tb_post';
    protected $fillable = [
        'id', 'title', 'slug', 'contents', 'views', 'status', 'created_by', 'image', 'image_thumb', 
        'post_category_id','post_daerah_id','tags','date_publish','author','editor','jenis_post'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
 
    public function getAllByCategory($category, $jenis = 'general'){
        $data = Self::select('tb_post.*')->selectRaw('pc.slug as slug_category')
        ->join('tb_post_category as pc','pc.id','=','tb_post.post_category_id')
        ->where('pc.slug',$category)->where('pc.jenis',$jenis)->get();
    
        return $data;
    }
 
    public function getPost($category, $post){
        $data = Self::select('tb_post.*')->selectRaw('pc.slug as slug_category')
        ->join('tb_post_category as pc','pc.id','=','tb_post.post_category_id')
        ->where('pc.slug',$category)->where('tb_post.slug',$post)->first();
    
        return $data;
    }
}
