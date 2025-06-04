<?php
namespace App\Http\Controllers;

use App\Events\PostEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DataTables;
use Validator;
use session;
use App\Models\Prestamo;
use App\Models\Mov_prestamo;
use App\Models\Bibliografia;
use App\Models\Post;
use App\Notifications\PostNotification;
use App\User;
use Illuminate\Support\Facades\Notification;

class VencidoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuario = Auth::user()->username;
        $rol = Auth::user()->role_id;

        if(request()->ajax())
        {
            if ($rol== 1){
                $vencidos = Prestamo::select("teca.titulo" , "prestamo.*", "teca.id_id",  "ubicaciones.ubicacion" )
                ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
                ->join("ubicaciones", "teca.id_ubicacion", "=", "ubicaciones.id_ubicacion")
                ->where("id_pres_estado" , 3)
                ->whereNull('fecha_devolucion')
                ->whereDate('fecha_estimada_devolucion', '<', Carbon::now()->format('Y-m-d'))
                ->get();
                return datatables()->of($vencidos)
                    ->addColumn('action', function($data){
                            $button = '<button type="button" name="reclama" id="'.$data->id.'" class="reclama btn btn-danger btn-sm">Reclamar</button>';
                            return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            } else {
                $vencidos = Prestamo::select("teca.titulo" , "prestamo.*", "teca.id_id",  "ubicaciones.ubicacion")
                 ->join("teca", "prestamo.id_biblioteca" , "=", "teca.id_biblioteca")
                 ->join("ubicaciones", "teca.id_ubicacion", "=", "ubicaciones.id_ubicacion")
                 ->where("id_pres_estado" , 3)
                 ->whereNull('fecha_devolucion')
                 ->where("agente_prestamo" , "=" , $usuario)
                 ->whereDate('fecha_estimada_devolucion', '<', Carbon::now()->format('Y-m-d'))
                 ->get();
                 return datatables()->of($vencidos)
                     ->addColumn('action', function($data){
                     $button = '<button type="button" name="renueva" id="'.$data->id.'" class="renueva btn btn-danger btn-sm">Renovar</button>';
                     return $button;
                      })
                 ->rawColumns(['action'])
                 ->make(true);
            }

        }

            return view('vencido.index');
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

        if ($vencido->id_confirma){

            $maximovalor= DB::table('pres_movimiento')
            ->max('id_pres_movimiento');

            $prestamo = Prestamo::FindOrFail($vencido->id_confirma);
            $form_data = array(
                'id_pres_movimiento' => $maximovalor + 1,
                'id_prestamo'        =>  $prestamo->id_prestamo,
                'id_tipo_movimiento' =>  4,
                'fecha_movimiento' => date('Y-m-d'),
                'agente_responsable' => $prestamo->agente_prestamo
            );
            Mov_prestamo::create($form_data);

            session()->flash('message.level', 'success');
            session()->flash('message.content', 'La biliografia ha sido reclamada');

            /* se crea la notificacion de la solicitud de devolucion del libro */
            $titulo = DB::table('teca')
                        ->where('id_biblioteca', $prestamo->id_biblioteca)
                        ->first();

            $notificacion = array(
                      'user_id' => Auth::id(),
                      'titulo' => "Reclamo devolucion",
                      'descripcion' => "Material reclamado : " .$titulo->titulo,

            );
            $post = Post::create($notificacion);

            /* se notifica solo al usuario que se le hace el reclamo */

            $model = User::where('username', $prestamo->agente_prestamo)->firstOrFail();

            $model->notify(new PostNotification($post));

            /* notifica a todos los usuarios */
                //event(new PostEvent($post));


        }
        if ($vencido->id_renueva){

             /* se renueva la fecha de devolucion del libro */
            $dias = DB::table('pres_limite')->where('id_pres_limite', 1 )->value('limite');
            $dia_devolucion = fechadevolucion(date('Y-m-d'), $dias);
            $form_data = array(
                'fecha_estimada_devolucion' => $dia_devolucion,
            );
            Prestamo::whereId($vencido->id_renueva)->update($form_data);

            /* se crea un nuevo movimiento en la tabla de movimientos */

            $maximovalor= DB::table('pres_movimiento')
            ->max('id_pres_movimiento');
            $prestamo = Prestamo::FindOrFail($vencido->id_renueva);
            $form_data = array(
                'id_pres_movimiento' => $maximovalor + 1,
                'id_prestamo'        =>  $prestamo->id_prestamo,
                'id_tipo_movimiento' =>  4,
                'fecha_movimiento' => date('Y-m-d'),
                'agente_responsable' => $prestamo->agente_prestamo
            );
            Mov_prestamo::create($form_data);
            session()->flash('message.level', 'success');
            session()->flash('message.content', 'La biliografia ha sido renovada');
        }

        return redirect()->route('vencido.index');
    }



}
