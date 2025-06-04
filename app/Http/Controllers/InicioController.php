<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DataTables;
use Validator;
use App\Models\Autor;
use App\Models\Bibliografia;
use App\Models\Categoria;
use App\Models\Prestamo;
use App\Models\Estado;
use App\Models\Material;
use App\Models\Ubicacion;
use App\Models\Notificaciones;


class InicioController extends Controller
{



    public function index()
    {


        $usuario = Auth::user()->username;

        /*  Libros prestados actualmente */
        $solicitados = Bibliografia::where('teca.id_pres_estado', 1)->count();


        $sindevolver = Prestamo::select("prestamo.*", "teca.titulo")
            ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
            ->where("id_pres_estado" , 3)
            ->whereNull('fecha_devolucion')
            ->count();



        /*  Ultimos 4 libros incoporados */
        $libros = Bibliografia::latest()
               ->take(4)
               ->get();

        /* Libros vencidos Administrador */
        $vencidos = Prestamo::select("prestamo.*", "teca.titulo")
        ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
        ->where("teca.id_pres_estado" , 3)
        ->whereNull('fecha_devolucion')
        ->whereDate("fecha_estimada_devolucion", "<", date('Y-m-d'))
        ->count();


        /* Libros vencidos usuario */
        $vencidosusuario = Prestamo::select("prestamo.*", "teca.titulo")
        ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
        ->where("teca.id_pres_estado" , 3)
        ->where("agente_prestamo" , "=" , $usuario)
        ->whereNull('fecha_devolucion')
        ->whereDate("fecha_estimada_devolucion", "<", date('Y-m-d'))
        ->count();


        /* Libros pedidos por un usuario */
        $pedidosusuario = Prestamo::select("prestamo.*", "teca.titulo")
        ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
        ->where("agente_prestamo" , "=" , $usuario)
        ->count();

        /* Libros pedidos por los usuario */
         $totalsolicitados = Prestamo::all()->count();

        /* Cantidad de libros en biblioteca */
         $totalactivos = Bibliografia::count();


         return view ('inicio', compact("totalactivos", "libros", "vencidos", "solicitados", "vencidosusuario", "pedidosusuario", "sindevolver", "totalsolicitados"));
    }
}
