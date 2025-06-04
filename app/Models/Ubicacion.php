<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    protected $fillable = [
        'id_ubicacion',
        'id_categoria',
        'ubicacion'
    ];

    public static $rules =[
       'id_categoria' => 'required',
       'ubicacion' => 'required',
    ];
}
