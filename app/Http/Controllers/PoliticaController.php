<?php

namespace App\Http\Controllers;

use App\Models\Politica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;

class PoliticaController extends Controller
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
            $data = politica::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('politica.index');
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
            'politica'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('politicaes')
              ->max('id_politica');


        $form_data = array(
            'politica'        =>  $request->politica,
            'id_politica'         => $maximovalor + 1
        );

        politica::create($form_data);

        return response()->json(['success' => 'La politica ha sido creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\politica  $politica
     * @return \Illuminate\Http\Response
     */
    public function show(politica $politica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\politica  $politica
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        {
            if(request()->ajax())
            {
                $data = politica::findOrFail($id);
                return response()->json(['result' => $data]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\politica  $politica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, politica $politica)
    {
        $rules = array(
            'politica'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'politica'    =>  $request->politica
        );

        politica::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\politica  $politica
     * @return \Illuminate\Http\Response
     */
    public function destroy(politica $politica)
    {
        //
    }
}
