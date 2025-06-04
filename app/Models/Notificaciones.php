<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';
    protected $fillable = [
        'user_notifica',
        'user_notificado',
        'tipo',
        'leido',
        'fecha'
    ];
}
