<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tb_menu';
    protected $fillable = [
        'id','page_id', 'group_menu', 'name', 'link', 'icon', 'keterangan', 'is_active', 'is_parent', 'order', 'status'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];

    public function submenu()
    {
        return $this->hasMany(Menu::class, 'is_parent')->with('submenu');
    }
    
}
