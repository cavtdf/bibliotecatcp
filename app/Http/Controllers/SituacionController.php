<?php

namespace App\Http\Controllers;

use App\Models\Situacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;


class SituacionController extends Controller
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
            $data = situacion::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('situacion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'situacion'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('situaciones')
              ->max('id_situacion');


        $form_data = array(
            'situacion'        =>  $request->situacion,
            'id_situacion'         => $maximovalor + 1
        );

        situacion::create($form_data);

        return response()->json(['success' => 'La situacion ha sido creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\situacion  $situacion
     * @return \Illuminate\Http\Response
     */
    public function show(situacion $situacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\situacion  $situacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        {
            if(request()->ajax())
            {
                $data = situacion::findOrFail($id);
                return response()->json(['result' => $data]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\situacion  $situacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, situacion $situacion)
    {
        $rules = array(
            'situacion'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'situacion'    =>  $request->situacion
        );

        situacion::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\situacion  $situacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(situacion $situacion)
    {
        //
    }
}
