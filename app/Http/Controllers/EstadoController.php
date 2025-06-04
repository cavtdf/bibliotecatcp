<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;

class EstadoController extends Controller
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
            $data = estado::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('estado.index');
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
            'estado'    =>  'required',
            'descripcion' =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('estados')
              ->max('id_estado');


        $form_data = array(
            'estado'       =>  $request->estado,
            'id_estado'    => $maximovalor + 1,
            'descripcion'  =>  $request->descripcion
        );

        estado::create($form_data);

        return response()->json(['success' => 'el estado ha sido creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if(request()->ajax())
            {
                $data = estado::findOrFail($id);
                return response()->json(['result' => $data]);
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estado $estado)
    {
        $rules = array(
            'estado'        =>  'required',
            'descripcion'   =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'estado'    =>  $request->estado,
            'descripcion'    =>  $request->descripcion
        );

        estado::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(estado $estado)
    {
        //
    }
}
