<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DateTime;
use Validator;
use sesion;
use Illuminate\Support\Facades\Redirect;
use App\Models\Autor;
use App\Models\Bibliografia;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Estado;
use App\Models\Material;
use App\Models\Limite;
use App\Models\Prestamo;
use App\Models\Ubicacion;

class PrestamoController extends Controller
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

            $bibliografia = DB::table('teca')
            ->join("autores", "teca.id_autor", "=", "autores.id_autor" )
            ->join("categorias", "teca.id_categoria", "=", "categorias.id_categoria" )
            ->join("editoriales", "teca.id_editorial", "=", "editoriales.id_editorial" )
            ->join("tipos", "teca.id_tipo", "=", "tipos.id_tipo" )
            ->join("estados", "teca.id_estado", "=", "estados.id_estado" )
            ->join("pres_estado", "teca.id_pres_estado", "=", "pres_estado.id_pres_estado" )
            ->select("teca.*","autores.autor", "categorias.categoria", "editoriales.editorial", "tipos.tipo", "estados.estado", "pres_estado.estado_prestamo" )
            ->latest()
            ->get();
            return datatables()->of($bibliografia)
            ->addColumn('btn', 'prestamo.btn')
                   ->rawColumns(['btn'])
                    ->make(true);

        }

        return view('prestamo.index');
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
            'prestamo'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $maximovalor= DB::table('prestamos')
              ->max('id_prestamo');


        $form_data = array(
            'prestamo'        =>  $request->prestamo,
            'id_prestamo'         => $maximovalor + 1
        );

        prestamo::create($form_data);

        return response()->json(['success' => 'La prestamo ha sido creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $dias = DB::table('pres_limite')->where('id_pres_limite', 1 )->value('limite');
        $dia_devolucion = fechadevolucion(date('Y-m-d'), $dias);
        $dt = new DateTime($dia_devolucion);
        $data = Bibliografia::findOrFail($id);
            $categoria = Categoria::where('id_categoria', '=', $data->id_categoria)->get()->first();
            $autores = Autor::where('id_autor', '=', $data->id_autor)->get()->first();
            $editoriales = Editorial::where('id_editorial', '=', $data->id_editorial)->get()->first();
            return view('prestamo.show' , compact("data", "editoriales", "autores", "categoria", "dt"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            if(request()->ajax())
            {
                $data = Bibliografia::findOrFail($id);
                return response()->json(['result' => $data]);
            }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, $id)
    {
        /* se actualiza el estado del libro de "DISPONIBLE"a "SOLICITADO"*/
        $form_data = array(
            'id_pres_estado'  =>  1,
        );
        Bibliografia::whereId($id)->update($form_data);

        /* se crea el registro del nuevo prestamo */
        $dias = DB::table('pres_limite')->where('id_pres_limite', 1 )->value('limite');
        $dia_devolucion = fechadevolucion(date('Y-m-d'), $dias);
        $libro = DB::table('teca')->where('id', $id )->value('id_biblioteca');
        $maximovalor= DB::table('prestamo')
        ->max('id_prestamo');

        $usuario = Auth::user()->username;

        $prestamo_data = array(
            'id_prestamo'     => $maximovalor + 1,
            'id_biblioteca'   => $libro,
            'agente_prestamo' => $usuario,
            'fecha_solicitud' => date('Y-m-d'),
            'fecha_estimada_devolucion' => $dia_devolucion

        );
        prestamo::create($prestamo_data);
        session()->flash('message.level', 'success');
        session()->flash('message.content', 'Puede pasar a retirar la bibliografia por Mesa de Entradas de Secretaria Legal en el horario de 08:30 a 14:30 hs.');
        return redirect('/prestamo');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(prestamo $prestamo)
    {
        //
    }



}
