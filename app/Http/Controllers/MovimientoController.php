<?php

namespace App\Http\Controllers;

use App\Models\movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;



class movimientoController extends Controller
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
            $data = movimiento::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('movimiento.index');
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
            'tipo_movimiento'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('tipo_movimientos')
              ->max('id_tipo_movimiento');


        $form_data = array(
            'tipo_movimiento'      =>  $request->tipo_movimiento,
            'id_tipo_movimiento'   => $maximovalor + 1
        );

        movimiento::create($form_data);

        return response()->json(['success' => 'El movimiento ha sido creado']);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function show(movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = movimiento::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, movimiento $movimiento)
    {
        $rules = array(
            'tipo_movimiento'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'tipo_movimiento'    =>  $request->tipo_movimiento
        );

        movimiento::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(movimiento $movimiento)
    {
        //
    }
}
