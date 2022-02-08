<?php

namespace App\Providers;

use View;
use App\Models\CategoriaReceta;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //pasar las categorias a la vista
        View::composer('*', function($view) {

            $categorias = CategoriaReceta::all();
            $view->with('categorias',$categorias);
        });

    }
}
