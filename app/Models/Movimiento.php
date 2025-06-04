<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'tipo_movimientos';
    protected $fillable = [
        'id_tipo_movimiento',
        'tipo_movimiento'
    ];

    public static $rules =[
       'tipo_movimiento' => 'required|min:2'
    ];
}
