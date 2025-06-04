<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DataTables;
use Validator;
use session;
use App\Models\Prestamo;
use App\Models\Autor;
use App\Models\Mov_prestamo;
use App\Models\Bibliografia;

class LibroController extends Controller
{


        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            if(request()->ajax())

            {
                $usuario = Auth::user()->username;
                $solicitados = Prestamo::select("teca.titulo" ,"autores.autor","teca.id_pres_estado", "prestamo.*" )
                ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
                ->join("autores", "teca.id_autor" , "=", "autores.id_autor")
                ->where("agente_prestamo" , "=" , $usuario)
                ->orderBy('fecha_solicitud', 'desc')
                ->get();
                return datatables()->of($solicitados)
                   ->addColumn('btn', 'libro.btn')
                   ->rawColumns(['btn'])
                    ->make(true);
            }
            return view('libro.index');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\vencido  $vencido
         * @return \Illuminate\Http\Response
         */
        public function update(Request $vencido)
        {
            $usuario = Auth::user()->username;
            $maximovalor= DB::table('pres_movimiento')
            ->max('id_pres_movimiento');

            $prestamo = Prestamo::FindOrFail($vencido->id_confirma);

            $form_data = array(
                'id_pres_movimiento' => $maximovalor + 1,
                'id_prestamo'        =>  $prestamo->id_prestamo,
                'id_tipo_movimiento' =>  4,
                'fecha_movimiento' => date('Y-m-d'),
                'agente_responsable' => $usuario,
            );
            Mov_prestamo::create($form_data);

            session()->flash('message.level', 'success');
            session()->flash('message.content', 'La biliografia ha sido reclamada');
            return redirect()->route('vencido.index');
        }



}
