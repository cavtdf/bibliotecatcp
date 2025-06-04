<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'tipos';
    protected $fillable = [
        'id_tipo',
        'tipo',
        'estado_tipo'
    ];

    public static $rules =[
       'tipo' => 'required|min:2',
       'estado_tipo' => 'required'
    ];
}
