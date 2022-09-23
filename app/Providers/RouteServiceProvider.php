<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        // Admin Routes
        $this->mapAdminProfileRoutes();
        $this->mapAdminEmployeeRoutes();
        $this->mapAdminTeamLeaderRoutes();
        $this->mapAdminLeadRoutes();
        // End Admin Routes

        // Team Leader Routes
        $this->mapTeamLeaderProfileRoutes();
        $this->mapTeamLeaderTmeRoutes();
        // End Tema Leader Routes

        // TME Routes
        $this->mapTelemarketingExecutiveProfileRoutes();
        // End TME Routes
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminProfileRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'employee-auth', 'admin'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/profile.php'));
    }

    protected function mapAdminEmployeeRoutes()
    {
        Route::prefix('admin/employees')
            ->middleware(['web', 'employee-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/employees.php'));
    }

    protected function mapAdminTeamLeaderRoutes()
    {
        Route::prefix('admin/team-leader')
            ->middleware(['web', 'employee-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/team_leader.php'));
    }

    protected function mapAdminLeadRoutes()
    {
        Route::prefix('admin/lead')
            ->middleware(['web', 'employee-auth', 'admin'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/lead.php'));
    }

    protected function mapTeamLeaderProfileRoutes()
    {
        Route::prefix('team-leader')
            ->middleware(['web', 'employee-auth', 'check_punch_in'])
            ->namespace($this->namespace)
            ->group(base_path('routes/team_leader/profile.php'));
    }

    protected function mapTeamLeaderTmeRoutes()
    {
        Route::prefix('team-leader/tme')
            ->middleware(['web', 'employee-auth', 'check_punch_in'])
            ->namespace($this->namespace)
            ->group(base_path('routes/team_leader/tme.php'));
    }

    protected function mapTelemarketingExecutiveProfileRoutes()
    {
        Route::prefix('telemarketing-executive')
            ->middleware(['web', 'employee-auth', 'check_punch_in'])
            ->namespace($this->namespace)
            ->group(base_path('routes/tme/profile.php'));
    }
}
