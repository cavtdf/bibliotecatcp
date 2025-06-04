<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;
use App\Http\Requests\RolStoreRequest;
use App\Http\Requests\RolUpdateRequest;
use Illuminate\Support\Facades\Gate;

class RolController extends Controller
{
    public function __construct()
    {
        // Asegurarse de que solo los administradores (o quienes puedan gestionar roles) accedan a estos métodos
        $this->middleware('auth'); // Asegurar que el usuario esté autenticado
        // Podrías usar un Gate específico como 'manage-roles' si lo definiste en AuthServiceProvider
        // Por ahora, usaremos el Gate 'administrador' ya definido para simplicidad
        $this->middleware('can:administrador');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // El middleware 'can:administrador' ya protege este método
        $roles = Rol::all();
        return view('rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // El middleware 'can:administrador' ya protege este método
        return view('rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RolStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolStoreRequest $request)
    {
        // La validación la maneja RolStoreRequest
        // El middleware 'can:administrador' ya protege este método

        Rol::create($request->validated());

        return redirect()->route('rol.index')->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        // Implementar si es necesario mostrar detalles de un rol individual
         abort(404); // O retornar una vista de detalle
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        // El middleware 'can:administrador' ya protege este método
        return view('rol.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RolUpdateRequest  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(RolUpdateRequest $request, Rol $rol)
    {
        // La validación la maneja RolUpdateRequest
        // El middleware 'can:administrador' ya protege este método

        $rol->update($request->validated());

        return redirect()->route('rol.index')->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        // El middleware 'can:administrador' ya protege este método

        // Opcional: Prevenir la eliminación de roles predeterminados (administrador, usuario)
        if ($rol->id === 1 || $rol->id === 2) { // Asumiendo IDs 1 y 2 para administrador y usuario
            if (request()->ajax()) {
                 return response()->json(['message' => 'No se pueden eliminar roles predeterminados.'], 403);
            }
             return redirect()->route('rol.index')->with('error', 'No se pueden eliminar roles predeterminados.');
        }

        $rol->delete();

        // Retornar respuesta JSON si es petición AJAX
        if (request()->ajax()) {
            return response()->json(['message' => 'Rol eliminado correctamente.']);
        }

        // Redireccionar si no es una petición AJAX
        return redirect()->route('rol.index')->with('success', 'Rol eliminado correctamente.');
    }
}
