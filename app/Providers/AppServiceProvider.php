<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Importar las interfaces y sus implementaciones
use App\Repositories\Rol\RoleRepositoryInterface;
use App\Repositories\Rol\RoleRepository;

use App\Repositories\Position\PositionRepositoryInterface;
use App\Repositories\Position\PositionRepository;

use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\Employee\EmployeeRepository;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Vincular interfaces con implementaciones
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PositionRepositoryInterface::class, PositionRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
  
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
