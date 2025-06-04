<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Definir Gate para verificar si el usuario es administrador
        Gate::define('administrador', function ($user) {
            return $user->role_id == 1; // Asumiendo que role_id 1 es administrador
        });

        // Definir Gate para gestionar bibliografía (CRUD completo)
        Gate::define('manage-bibliografia', function ($user) {
            return $user->role_id == 1; // Solo administradores pueden gestionar bibliografía
        });

        // Definir Gate para gestionar usuarios (CRUD completo)
        Gate::define('manage-users', function ($user) {
            return $user->role_id == 1; // Solo administradores pueden gestionar usuarios
        });

        // Definir Gate para ver bibliografía (para todos los usuarios logeados)
        Gate::define('view-bibliografia', function ($user) {
            return $user !== null; // Permitir si el usuario está autenticado
        });

        // Definir Gate para solicitar un préstamo (para usuarios comunes)
        Gate::define('request-prestamo', function ($user) {
            return $user->role_id != 1; // Solo usuarios que no son administradores pueden solicitar préstamos
        });

        Gate::before(function($user, $ability) {
            if ($user->role_id == 1) {
                return true;
            }
            return null;
        });

        //
    }
}
