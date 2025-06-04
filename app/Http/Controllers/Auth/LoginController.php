<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rol;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     *
     *   protected $redirectTo = '/';
     *   RouteServiceProvider::HOME;
     *
     *
     *
     * Create a new controller instance.
     *
     * @return void
     */

     public function redirectTo(){

     //dd(Auth::user());
     $rol = Auth::user()->role_id;
     // La lógica de asignación de rol aquí es incorrecta para la estructura actual de la base de datos
     // y está causando inserciones incorrectas en la tabla 'roles'.
     // Eliminaremos esta lógica.

       switch ($rol) {
           case '1':
              return '/';
              break;
           default:
              return '/';
              break;
       }

     }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function credentials(Request $request)
    {
        return [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];
    }

    public function username()
    {
        return 'username';
    }
}
