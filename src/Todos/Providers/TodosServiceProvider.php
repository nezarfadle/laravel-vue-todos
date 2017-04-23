<?php

namespace Todos\Providers;

use Illuminate\Support\ServiceProvider;

class TodosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \View::addNamespace('todos', base_path('src/Todos/Views'));
    }
}
