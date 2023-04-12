<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory;
use App\Models\PostPages;
use App\Models\User;
use Log;

class Post extends Model
{
    protected $table = 'tb_post';
    protected $fillable = [
        'id', 'title', 'description', 'slug', 'contents', 'views', 'status', 'created_by', 'image', 'image_thumb', 
        'post_category_id','post_daerah_id','tags','date_publish','author','editor','jenis_post'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];

    public function category(){
        return $this->belongsTo(PostCategory::class,'post_category_id','id');
    }

    public function pages(){
        return $this->hasMany(PostPages::class,'post_id','id');
    }

    public function createdby(){
        return $this->belongsTo(User::class,'created_by','id');
    }
 
    public function getAllByCategory($category, $jenis = 'general'){
        $data = Self::select('tb_post.*')->selectRaw('pc.slug as slug_category')
        ->join('tb_post_category as pc','pc.id','=','tb_post.post_category_id')
        ->where('pc.slug',$category)->where('pc.jenis',$jenis)->get();
    
        return $data;
    }
 
    public function getAllByPages($page){
        $data = Self::select('tb_post.*')->selectRaw('pc.slug as slug_category')
        ->join('tb_post_category as pc','pc.id','=','tb_post.post_category_id')
        ->join('tb_post_pages as pp','pp.post_id','=','tb_post.id')
        ->join('tb_pages as p','p.id','=','pp.page_id')
        ->where('p.slug',$page)
        ->orderBy('tb_post.date_publish','desc')
        ->get();
    
        return $data;
    }
 
    public function getPost($category, $post){
        $data = Self::select('tb_post.*','pc.name as category')
        ->selectRaw('pc.slug as slug_category')
        ->join('tb_post_category as pc','pc.id','=','tb_post.post_category_id')
        ->where('pc.slug',$category)->where('tb_post.slug',$post)->first();
    
        return $data;
    }
}
