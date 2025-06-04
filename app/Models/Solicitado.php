<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitado extends Model
{
    protected $table = 'prestamo';
    protected $fillable = [
        'fecha_entregado',
        'fecha_estimada_devolucion'
    ];

    public static $rules =[
       'fecha_entregado' => 'required'
    ];
}
