<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestadoController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $solicitadostodos = Prestamo::select("teca.id_id","teca.titulo" ,"autores.autor", "prestamo.*", "ubicaciones.ubicacion")
            ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
            ->join("ubicaciones", "teca.id_ubicacion", "=", "ubicaciones.id_ubicacion")
            ->join("autores", "teca.id_autor" , "=", "autores.id_autor")
            ->get();
            return datatables()->of($solicitadostodos)->toJson();;
        }
        return view('prestado.index');
    }
}

