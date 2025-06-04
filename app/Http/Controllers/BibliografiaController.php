<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Validator;
use Illuminate\Support\Arr;
use App\Models\Autor;
use App\Models\Bibliografia;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Estado;
use App\Models\Material;
use App\Models\Prestamo;
use App\Models\Ubicacion;
use App\Models\Situacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;



class BibliografiaController extends Controller
{
    public function __construct()
    {
        // Aplicar middleware 'auth' a todos los métodos del controlador
        $this->middleware('auth');

        // Proteger métodos con Gates
        $this->middleware('can:view-bibliografia')->only('index', 'show'); // Aplicar a index y show nuevamente
        $this->middleware('can:manage-bibliografia')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // El Gate 'view-bibliografia' ya protege este método
        if(request()->ajax())
        {
             $bibliografia = Bibliografia::with(['ubicacion', 'autor', 'categoria', 'editorial', 'tipo', 'estado', 'situacionPrestamo'])
                                        ->latest()
                                        ->get();

            return datatables()->of($bibliografia)
                ->addColumn('id', function($row){
                    return $row->id_biblioteca;
                })
                ->addColumn('ubicacion', function(Bibliografia $bibliografia) {
                    return $bibliografia->ubicacion->ubicacion ?? '';
                })
                ->addColumn('autor', function(Bibliografia $bibliografia) {
                    return $bibliografia->autor->autor ?? '';
                })
                ->addColumn('categoria', function(Bibliografia $bibliografia) {
                    return $bibliografia->categoria->categoria ?? '';
                })
                ->addColumn('editorial', function(Bibliografia $bibliografia) {
                    return $bibliografia->editorial->editorial ?? '';
                })
                ->addColumn('tipo', function(Bibliografia $bibliografia) {
                    return $bibliografia->tipo->tipo ?? '';
                })
                 ->addColumn('estado', function(Bibliografia $bibliografia) {
                    return $bibliografia->estado->estado ?? '';
                })
                 ->addColumn('estado_prestamo', function(Bibliografia $bibliografia) {
                    return $bibliografia->situacionPrestamo->estado_prestamo ?? '';
                })
                ->addColumn('btn', 'bibliografia.btn')
                ->addColumn('btn1', 'bibliografia.btn1')
                ->addColumn('btn2', 'bibliografia.btn2')
                ->rawColumns(['btn','btn1','btn2'])
                ->make(true);
        }

        return view('bibliografia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $tipos = Material::all();
        $autores = Autor::all();
        $editoriales = Editorial::all();
        $ubicaciones = Ubicacion::all();
        $estados = Estado::all();

        return view('bibliografia.create' , compact("estados", "ubicaciones", "editoriales", "autores", "tipos", "categorias"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required',
            'tipo' => 'required',
            'titulo' => 'required|string|max:255',
            'autor' => 'required',
            'editorial' => 'required',
            'isbn' => 'nullable|string|max:255',
            'ubicacion' => 'required',
            'estado' => 'required',
            'descripcion' => 'nullable|string',
            'notas' => 'nullable|string',
        ]);

        $usuario = Auth::user()->username;

        $formData = [
            "id_categoria" => $request->categoria,
            "id_tipo" => $request->tipo,
            "titulo" => $request->titulo,
            "id_autor" => $request->autor,
            "id_editorial" => $request->editorial,
            "isbn" => $request->isbn,
            "id_ubicacion" => $request->ubicacion,
            "id_estado" => $request->estado,
            "id_pres_estado" => 2, // Asumimos que 2 es el estado inicial (Disponible)
            "descripcion" => $request->descripcion,
            "notas" => $request->notas,
            "cargado_por" => $usuario,
            // id_biblioteca y id_id se manejarán por la base de datos (auto-incremental)
        ];

        if (Bibliografia::create($formData)){
          $request->session()->flash('message.level', 'success');
          $request->session()->flash('message.content', 'La nueva bibliografia ha sido creada Exitosamente');
        } else {
         $request->session()->flash('message.level', 'danger');
         $request->session()->flash('message.content', 'Error!');
        }
      return redirect()->route('bibliografia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $data = Bibliografia::with(['ubicacion', 'autor', 'categoria', 'editorial', 'tipo', 'estado', 'situacionPrestamo'])
                                ->findOrFail($id);

            // Buscar el último préstamo activo para esta bibliografía
            $solicitadoPorPrestamo = Prestamo::where('id_biblioteca', $data->id_biblioteca)
                                            ->whereNull('fecha_devolucion')
                                            ->latest('fecha_solicitud') // Obtener el último por fecha de solicitud
                                            ->with('agente') // Cargar la relación con el usuario solicitante
                                            ->first();

            $solicitadopor = $solicitadoPorPrestamo ? $solicitadoPorPrestamo->agente->username ?? 'Desconocido' : 'false'; // Obtener el username o 'Desconocido'
            $newDate = $solicitadoPorPrestamo ? date("d/m/Y", strtotime($solicitadoPorPrestamo->fecha_solicitud)) : NULL;

            // Ya no necesitamos obtener categoría, autor, editorial, etc. por separado gracias a with() en $data

            return view('bibliografia.show' , compact("data", "solicitadopor", "newDate"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
            $data = Bibliografia::findOrFail($id);
            $categorias = Categoria::all();
            $tipos = Material::all();
            $autores = Autor::all();
            $editoriales = Editorial::all();
            $ubicaciones = Ubicacion::all();
            $estados = Estado::all();
            return view('bibliografia.edit' , compact("data", "estados", "ubicaciones", "editoriales", "autores", "tipos", "categorias"));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $libro = Bibliografia::findOrFail($id);

        // Validar los datos de entrada
        $request->validate([
            'categoria' => 'required',
            'tipo' => 'required',
            'titulo' => 'required|string|max:255',
            'autor' => 'required',
            'editorial' => 'required',
            'isbn' => 'nullable|string|max:255',
            'ubicacion' => 'required',
            'estado' => 'required',
            'descripcion' => 'nullable|string',
            'notas' => 'nullable|string',
        ]);

        $updateData = [
            "id_categoria" => $request->categoria,
            "id_tipo" => $request->tipo,
            "titulo" => $request->titulo,
            "id_autor" => $request->autor,
            "id_editorial" => $request->editorial,
            "isbn" => $request->isbn,
            "id_ubicacion" => $request->ubicacion,
            "id_estado" => $request->estado,
            "descripcion" => $request->descripcion,
            "notas" => $request->notas,
        ];

        $usuario = Auth::user()->username;
        $updateData['actualizado_por'] = $usuario;

        $docStatus = $libro->update($updateData);

        if ($docStatus) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'La bibliografia ha sido actualizada Exitosamente');
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Se ha producido un error al actualizar, vuelva a intentarlo');
        }

        return redirect()->route('bibliografia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('manage-bibliografia');

        $bibliografia = Bibliografia::findOrFail($id);

        // Eliminar la imagen asociada si existe
        if ($bibliografia->foto) {
            Storage::disk('public')->delete('imagenes/caratulas/' . $bibliografia->foto);
        }

        // Eliminar el registro de la base de datos
        $bibliografia->delete();

        // Retornar respuesta JSON si es petición AJAX, de lo contrario redireccionar
        if (request()->ajax()) {
            return response()->json(['message' => 'Bibliografía eliminada correctamente.']);
        }

        return redirect()->route('bibliografia.index')->with('success', 'Bibliografía eliminada correctamente.');
    }
}
