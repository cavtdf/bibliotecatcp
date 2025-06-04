<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $fillable = [
        'id_estado',
        'estado',
        'descripcion'
    ];

    public static $rules =[
       'estado' => 'required|min:2',
       'descripcion' => 'required|min:2'
    ];
}

