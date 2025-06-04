<?php

namespace App\Http\Controllers;

use App\Models\Limite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;

class LimiteController extends Controller
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
            $data = limite::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('limite.index');
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
            'limite'    =>  'required',
            'descripcion' =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('pres_limite')
              ->max('id_pres_limite');


        $form_data = array(
            'limite'       =>  $request->limite,
            'id_pres_limite'    => $maximovalor + 1,
            'descripcion'  =>  $request->descripcion
        );

        limite::create($form_data);

        return response()->json(['success' => 'el limite ha sido creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function show(limite $limite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if(request()->ajax())
            {
                $data = limite::findOrFail($id);
                return response()->json(['result' => $data]);
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, limite $limite)
    {
        $rules = array(
            'limite'        =>  'required',
            'descripcion'   =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'limite'    =>  $request->limite,
            'descripcion'    =>  $request->descripcion
        );

        limite::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\limite  $limite
     * @return \Illuminate\Http\Response
     */
    public function destroy(limite $limite)
    {
        //
    }
}
