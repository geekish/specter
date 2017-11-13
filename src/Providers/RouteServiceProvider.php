<?php

namespace Specter\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Spatie\PaginateRoute\PaginateRouteFacade;
use Specter\Models;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Specter\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        PaginateRouteFacade::registerMacros();

        Route::bind('story', function (string $slug) {
            return Models\Story::slug($slug)
                ->with(['author', 'tags'])
                ->first()
                ?? abort(404);
        });

        Route::bind('post', function (string $slug) {
            return Models\Post::slug($slug)
                ->with(['author', 'tags'])
                ->first()
                ?? abort(404);
        });

        Route::bind('tag', function (string $slug) {
            return Models\Tag::slug($slug)
                ->with(['posts'])
                ->withCount(['posts'])
                ->first()
                ?? abort(404);
        });

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

        //
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
             ->group(specter_path('routes/web.php'));
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
             ->group(specter_path('routes/api.php'));
    }
}
