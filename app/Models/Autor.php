<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $fillable = [
        'id_autor',
        'autor'
    ];

    public static $rules =[
       'autor' => 'required|min:2'
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_autor';
}
