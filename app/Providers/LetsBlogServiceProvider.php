<?php

namespace SayWebSolutions\LetsBlog\Providers;

use Illuminate\Support\ServiceProvider;

class LetsBlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('letsblog', function () {
            return new LetsBlog;
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/letsblog.php',
            'letsblog'
        );

        $this->commands([
            'SayWebSolutions\LetsBlog\Console\LetsBlogBuild'
        ]);
    }

    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->publishes([
             __DIR__ . '/../../database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/letsblog')
        ], 'views');

        $this->publishes([
            __DIR__ . '/../../config' => config_path()
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('vendor/lets-blog')
        ], 'assets');
        
        require __DIR__ . '/../Support/helpers.php';

        require __DIR__ . '/../Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'letsblog');

//        $router->aliasMiddleware('lb_web', [
//            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        ]);
    }
}
