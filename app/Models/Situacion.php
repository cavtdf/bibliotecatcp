<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Situacion extends Model
{
    protected $table = 'pres_estado';
    protected $fillable = [
        'id_pres_estado',
        'estado_prestamo'
    ];

    public static $rules =[
       'estado_prestamo' => 'required'
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pres_estado';
}
