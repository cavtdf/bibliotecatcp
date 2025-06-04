<?php

namespace App\Http\Controllers;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use DataTables;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\Ubicacion;
use App\Models\Categoria;

class UbicacionController extends Controller
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
            $material = Ubicacion::select("ubicaciones.*","categorias.categoria" )
            ->join("categorias", "ubicaciones.id_categoria", "=", "categorias.id_categoria" )
            ->get();
            return datatables()->of($material)
                 ->addColumn('action', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Editar</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('ubicacion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria =Categoria::all();
        return view('ubicacion.create' , compact("categoria"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Ajustar validación: solo se requiere 'ubicacion'
        $rules = array(
            'ubicacion'  => 'required|min:2'
        );

        $error = \Validator::make($request->all(), $rules); // Usar el facade Validator

        if($error->fails())
        {
            // Si falla la validación, retornar JSON con errores
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // Restaurar lógica manual para id_ubicacion (no ideal, pero para coincidir con patrón anterior)
        $maximovalor= DB::table('ubicaciones')
              ->max('id_ubicacion');

        // Preparar datos para la creación (sin id_categoria)
        $form_data = array(
            'id_ubicacion'  => $maximovalor + 1,
            'ubicacion'     =>  $request->ubicacion,
            'id_categoria' => 1 // Asignar un valor por defecto para satisfacer la restricción de la base de datos
        );

        // Crear el registro usando Eloquent
        if (Ubicacion::create($form_data)) {
             // Si es exitoso, retornar JSON con mensaje de éxito
            return response()->json(['success' => 'La nueva ubicacion ha sido creada']);
        } else {
            // Si falla la creación, retornar JSON con mensaje de error
            return response()->json(['errors' => ['Error al crear la ubicación']]);
        }

        // Ya no se redirige, se retorna JSON
        // return redirect('/ubicacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria= Categoria::all();

        if ($ubicacion= Ubicacion::find($id)) {
           return view("ubicacion.edit", compact("ubicacion", "categoria")) ;
      } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Esa categoria no fue encontrada');
            return redirect("/categoria");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
