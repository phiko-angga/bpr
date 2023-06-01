<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'tb_pages';
    protected $fillable = [
        'id', 'title', 'slug', 'contents', 'views', 'status', 'created_by', 'is_top', 'image', 'image_thumb'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
    
    function pagesNotInMenu(){

        $pageInMenu = Menu::select('page_id')->whereNotNull('page_id')->get()->toArray();
        return Self::select('*')->whereNotIn('id',$pageInMenu)->get();
    }
}
