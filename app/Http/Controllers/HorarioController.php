<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;


class HorarioController extends Controller
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
            $data = horario::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('horario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'horario'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('horarioes')
              ->max('id_horario');


        $form_data = array(
            'horario'        =>  $request->horario,
            'id_horario'         => $maximovalor + 1
        );

        horario::create($form_data);

        return response()->json(['success' => 'El horario ha sido creado']);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = horario::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, horario $horario)
    {
        $rules = array(
            'desde'        =>  'required',
            'hasta'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'desde'    =>  $request->desde,
            'hasta'    =>  $request->hasta
        );

        horario::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(horario $horario)
    {
        //
    }
}
