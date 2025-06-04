<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Prestamo extends Model
{
    protected $table = 'prestamo';
    protected $fillable = [
        'id_prestamo',
        'id_biblioteca',
        'agente_prestamo',
        'fecha_solicitud',
        'fecha_entregado',
        'fecha_devolucion',
        'fecha_estimada_devolucion'

    ];

    // Relación con Bibliografia
    public function bibliografia()
    {
        return $this->belongsTo(\App\Models\Bibliografia::class, 'id_biblioteca', 'id_biblioteca');
    }

    // Relación con el usuario que solicitó el préstamo (asumiendo que agente_prestamo guarda el username)
    public function agente()
    {
        return $this->belongsTo(\App\User::class, 'agente_prestamo', 'username');
    }

    /*  public static function setCaratula($foto, $actual = false)
    {
        if ($foto) {
            if ($actual) {
                Storage::disk('public')->delete("imagenes/caratulas/$actual");
            }
            $imageName = Str::random(20) . '.jpg';
            $imagen = Image::make($foto)->encode('jpg', 75);
            $imagen->resize(530, 470, function ($constraint) {
                $constraint->upsize();
            });
            Storage::disk('public')->put("imagenes/caratulas/$imageName", $imagen->stream());
            return $imageName;
        } else {
            return false;
        }
    } */
}
