<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Limite extends Model
{
    protected $table = 'pres_limite';
    protected $fillable = [
        'id_pres_limite',
        'limite',
        'descripcion'
    ];

    public static $rules =[
       'limite' => 'required',
       'descripcion' => 'required'
    ];
}
