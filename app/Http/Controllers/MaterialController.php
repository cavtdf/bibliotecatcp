<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;
use App\Models\Estado;

class MaterialController extends Controller
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
                $material = Material::select("tipos.*","estados.estado" )
                ->join("estados", "tipos.estado_tipo", "=", "estados.id_estado" )
                ->get();
                return datatables()->of($material)
                        ->addColumn('action', function($data){
                            $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('material.index');

    }

    public function getEstados() {

        if(request()->ajax())
            {
               $data =Estado::all();
               return response()->json(['result' => $data]);
            }

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
            'material'  => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'tipo'        =>  $request->material,
            'estado_tipo' => 1 // Asignar un estado por defecto (ej. 1 para Activo)
            // id_tipo será autogenerado por la base de datos
        );

        Material::create($form_data);

        return response()->json(['success' => 'el material ha sido creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(material $material)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        {
            if(request()->ajax())
            {
                $data = material::findOrFail($id);
                return response()->json(['result' => $data]);

                $listas = '<option value="0">Elige una opción</option>';
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                  $listas .= "<option value='$row[id]'>$row[nombre]</option>";
                }

            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, material $material)
    {
        $rules = array(
            'material'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'material'    =>  $request->material
        );

        material::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Los datos han sido actualizados']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(material $material)
    {
        //
    }
}
