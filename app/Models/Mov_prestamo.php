<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mov_prestamo extends Model
{
    protected $table = 'pres_movimiento';
    protected $fillable = [
        'id_pres_movimiento',
        'id_prestamo',
        'id_tipo_movimiento',
        'fecha_movimiento',
        'agente_responsable'
    ];

}
