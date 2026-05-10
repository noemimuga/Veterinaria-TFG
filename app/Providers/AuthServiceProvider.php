<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Solicitud;
use App\Policies\SolicitudPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    /*protected $policies = [
        Solicitud::class => SolicitudPolicy::class,
    ];*/

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // -------------------------------
        // ROLES DEL SISTEMA
        // -------------------------------

        Gate::define('usuario', fn(User $user) => $user->tipo === 'users');
        Gate::define('refugio', fn(User $user) => $user->tipo === 'refugio');
        Gate::define('admin', fn(User $user) => $user->tipo === 'admin');
    }
}
