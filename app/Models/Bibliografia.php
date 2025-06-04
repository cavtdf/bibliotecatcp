<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Bibliografia extends Model
{
    protected $table = 'teca';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_biblioteca';

    protected $fillable = [
        'id_biblioteca',
        'id_categoria',
        'id_tipo',
        'id_id',
        'titulo',
        'id_autor',
        'id_editorial',
        'isbn',
        'id_ubicacion',
        'descripcion',
        'notas',
        'id_estado',
        'id_pres_estado',
        'cargado_por',
        'actualizado_por',
        'foto'
    ];

    public static $rules =[

    ];

    // Relaciones

    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function tipo()
    {
        return $this->belongsTo(\App\Models\Material::class, 'id_tipo', 'id_tipo');
    }

    public function autor()
    {
        return $this->belongsTo(\App\Models\Autor::class, 'id_autor', 'id_autor');
    }

    public function editorial()
    {
        return $this->belongsTo(\App\Models\Editorial::class, 'id_editorial', 'id_editorial');
    }

    public function ubicacion()
    {
        return $this->belongsTo(\App\Models\Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'id_estado', 'id_estado');
    }

    public function situacionPrestamo()
    {
        return $this->belongsTo(\App\Models\Situacion::class, 'id_pres_estado', 'id_pres_estado');
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
