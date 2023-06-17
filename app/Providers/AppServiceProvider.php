<?php

namespace App\Providers;

use App\Models\Empresa;
use App\Models\Moneda;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Http\Traits\SocialTrait;
use App\Models\ArqueoCaja;

class AppServiceProvider extends ServiceProvider
{
    use SocialTrait;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme("https");

        view()->composer(['panel.*'],function($view){

            $empresaGeneral = Empresa::query()->first();
            $monedaGeneral = Moneda::query()->find($empresaGeneral->idmoneda);

            $view->with(compact('empresaGeneral','monedaGeneral'));

        });

        view()->composer(['panel.arqueoCaja.abrirCaja'],function($view){

            $currentDate = now()->format('Y-m-d');
            $usuario = auth()->user()->usuario;

            $arqueoCajaAnterior = ArqueoCaja::query()->where( 'fecha', now()->subDays(1)->format('Y-m-d') )->first();
            $arqueoCajaCurrent = ArqueoCaja::query()->where( 'fecha', $currentDate )->first();

            $view->with(compact( 'currentDate', 'usuario', 'arqueoCajaAnterior', 'arqueoCajaCurrent' ));
        });







    }
}
