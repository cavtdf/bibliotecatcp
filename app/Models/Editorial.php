<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    protected $table = 'editoriales';
    protected $fillable = [
        'id_editorial',
        'editorial'
    ];

    public static $rules =[
       'editorial' => 'required|min:2'
    ];
}
