<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\SearchInterface;
use App\Utils\Search;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Establecer la longitud predeterminada de las cadenas de caracteres en la base de datos
        Schema::defaultStringLength(191);

        // Vincular la interfaz SearchInterface con su implementación Search
        $this->app->bind(SearchInterface::class, Search::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
