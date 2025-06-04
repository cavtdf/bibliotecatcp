<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $fillable = [
        'id_hora',
        'desde',
        'hasta'
    ];

    public static $rules =[
       'desde' => 'required',
       'hasta' => 'required'
    ];
}
