<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;
use App\User;
use App\Role;

class UsuarioController extends Controller
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
            $usuario = DB::table('users')
            ->join("roles", "users.role_id", "=","roles.id" )
            ->select("users.*","roles.name")
            ->get();
            return datatables()->of($usuario)
                   ->addColumn('btn', 'usuario.btn')
                   ->rawColumns(['btn'])
                    ->make(true);

        }

        return view('usuario.index');
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
            $data = User::findOrFail($id);
            $roles = Role::all();
            return view('usuario.edit' , compact("data", "roles"));

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
        $data = User::findOrFail($id);

        if ($data->update([
            "role_id" => $request["roles"],
        ]));

        $rol = $request["roles"];

        $data->asignarRol($rol);

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'El rol ha sido actualizada');
        return redirect('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bibliografia  $bibliografia
     * @return \Illuminate\Http\Response
     */
    public function destroy(bibliografia $bibliografia)
    {
        //
    }
}
