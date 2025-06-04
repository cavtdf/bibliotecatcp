<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Prestamo;
use App\Models\Bibliografia;
use App\Models\Mov_prestamo;
use Validator;

class DevolucionController extends Controller
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

            $devoluciones = Prestamo::select("prestamo.*", "teca.titulo", "teca.id_id","ubicaciones.ubicacion")
            ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
            ->join("ubicaciones", "teca.id_ubicacion", "=", "ubicaciones.id_ubicacion")
            ->where("id_pres_estado" , 3)
            ->whereNull('fecha_devolucion')
            ->get();
             return datatables()->of($devoluciones)
                ->addColumn('action', function($data){
                        $button = '<button type="button" name="recibir" id="'.$data->id.'" class="recibir btn btn-success btn-sm text-align-center">Recibir</button>';
                        return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('devolucion.index');
    }

     /**
     * Se crea un nuevo movimiento para el prestamo
     * se actualiza la tabla prestamo
     * se actualiza la tabla teca
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $prestamo = Prestamo::FindOrFail($request->id_confirma);
        $maximovalor= DB::table('pres_movimiento')->max('id_pres_movimiento');

        $form_data = array(
            'id_pres_estado'  =>  2,
        );
        Bibliografia::where('id_biblioteca', $prestamo->id_biblioteca)->update($form_data);

       // dd($request->all());

        /* se crea un nuevo movimiento de la tabla "pres_movimiento" */

        $movimiento = array(
            'id_pres_movimiento' => $maximovalor + 1,
            'id_prestamo'        =>  $prestamo->id_prestamo,
            'id_tipo_movimiento' =>  5,
            'fecha_movimiento' => date('Y-m-d'),
            'agente_responsable' => $prestamo->agente_prestamo,
        );
        Mov_prestamo::create($movimiento);

        $prestamo_data = array(
            'fecha_devolucion' => date('Y-m-d')
        );
        Prestamo::where('id_prestamo' , $prestamo->id_prestamo)->update($prestamo_data);
        session()->flash('message.level', 'success');
        session()->flash('message.content', 'La bibliografía ha sido devuelta');
        return redirect()->route('devolucion.index');
    }


}
