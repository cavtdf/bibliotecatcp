<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DateTime;
use DataTables;
use Validator;
use sesion;
use App\Models\Prestamo;
use App\Models\Bibliografia;
use App\Models\Solicitado;
use App\Models\Mov_prestamo;


class SolicitadoController extends Controller
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

            $pedidos = Prestamo::select("prestamo.*", "teca.titulo", "teca.id_id", "ubicaciones.ubicacion")
            ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
            ->join("ubicaciones", "teca.id_ubicacion" , "=", "ubicaciones.id_ubicacion")
            ->where("id_pres_estado" , 1)
            ->whereNull('fecha_devolucion')
            ->get();
             return datatables()->of($pedidos)
                ->addColumn('action', function($data){
                        $button = '<button type="button" name="entregar" id="'.$data->id.'" class="entregar btn btn-danger btn-sm">Entregar</button>';
                        $button = $button .' '. '<button type="button" name="cancelar" id="'.$data->id.'" class="cancelar btn btn-primary btn-sm">Cancelar</button>';
                        return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('solicitado.index');
    }

        /*
         *  Se crea un movimiento en la tabla "pres_movimiento"
         *  Se carga la fecha de entrega y se calcula la fecha de devolucion en la table "prestamo"
         *  Se actualiza el estado del libro
         */

    public function update(Request $request )
    {
        $dias = DB::table('pres_limite')->where('id_pres_limite', 1 )->value('limite');
        $dia_devolucion = fechadevolucion(date('Y-m-d'), $dias);
        $dt = new DateTime($dia_devolucion);

        $maximovalor= DB::table('pres_movimiento')
              ->max('id_pres_movimiento');

        $prestamo = Prestamo::FindOrFail($request->id_confirma);
        $actualiza_prestamo = array(
                'fecha_entregado' => date('Y-m-d'),
                'fecha_estimada_devolucion' => $dt
        );
        Prestamo::where('id_prestamo' , $prestamo->id_prestamo)->update($actualiza_prestamo);

        $form_data = array(
            'id_pres_movimiento' => $maximovalor + 1,
            'id_prestamo'        =>  $prestamo->id_prestamo,
            'id_tipo_movimiento' =>  1,
            'fecha_movimiento' => date('Y-m-d'),
            'agente_responsable' => $prestamo->agente_prestamo,
        );
        Mov_prestamo::create($form_data);

        DB::table('teca')
           ->where('id_biblioteca', $prestamo->id_biblioteca)
           ->update(['id_pres_estado' => 3]);

        session()->flash('message.level', 'success');
        session()->flash('message.content', 'el prestamo ha sido realizado');
        return redirect()->route('solicitado.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $unlibro)
    {
     /*  $delete = $unlibro -> all();*/


      $borraprestamo = Prestamo::FindOrFail($unlibro->codigo);
      $form_data = array(
        'id_pres_estado'  =>  2,
      );
      Bibliografia::where('id_biblioteca' , $borraprestamo->id_biblioteca)->update($form_data);
      $borraprestamo->delete();
      session()->flash('message.level', 'success');
      session()->flash('message.content', 'La bibliografía ha vuelto a estar disponible');
      return redirect()->route('libro.index');


    }
}
