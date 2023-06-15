<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'tb_config';
    protected $fillable = [
        'name','value'
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
    
}
