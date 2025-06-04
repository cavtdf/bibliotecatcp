<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('usuario.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('usuario.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        // La validación ya la hace UserStoreRequest

        // Verificar si el usuario ya existe por username o email
        $existingUser = User::where('username', $request->username)
                              ->orWhere('email', $request->email)
                              ->first();

        if ($existingUser) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['username' => 'El usuario o email ya existen.']);
        }

        // Crear el nuevo usuario
        $user = User::create([
            'names' => $request->names,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashear la contraseña
            'role_id' => $request->role_id ?? 2, // Asignar rol por defecto si no se especifica
        ]);

        // Redireccionar a la lista de usuarios o a donde prefieras
        return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente.');
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
        $user = User::findOrFail($id);
        $roles = Rol::all();
        return view('usuario.edit', compact('user', 'roles'));
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
        $request->validate([
            'names' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id, // Ignorar el usuario actual
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Ignorar el usuario actual
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        $userData = [
            'names' => $request->names,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Autorizar la acción de eliminar usuario (asegúrate de tener el Gate 'manage-users' o 'administrador')
        // Por ahora, asumimos que si llegas aquí, tienes permiso.
        // Puedes añadir $this->authorize('manage-users'); si lo necesitas.

        $user = User::findOrFail($id);

        // Opcional: Prevenir la eliminación del usuario actualmente autenticado
        if (Auth::check() && Auth::user()->id === $user->id) {
             return response()->json(['message' => 'No puedes eliminar tu propio usuario.'], 403);
        }

        $user->delete();

        // Retornar respuesta JSON para la llamada AJAX
        if (request()->ajax()) {
            return response()->json(['message' => 'Usuario eliminado correctamente.']);
        }

        // Redireccionar si no es una petición AJAX (aunque el botón usará AJAX)
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
