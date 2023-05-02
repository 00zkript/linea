<?php

namespace App\Providers;

use App\Models\Asesor;
use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\Empresa;
use App\Models\Favorito;
use App\Models\Marca;
use App\Models\Menu;
use App\Models\Moneda;
use App\Models\Popup;
use App\Models\Seo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Http\Traits\SocialTrait;

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


        view()->composer(['web.template.banner'],function ($view){

            $interalRoutesStatics = Arr::pluck((array)Menu::getRoutesInternal(),'key');

            $routeAlias = Route::currentRouteName();
            if( Route::current() === null ) return;
            $routeParameters = Route::current()->parameters();
            $routeParameterFirst = array_first($routeParameters);

            // $routeParameters = Route::current() !== null ? Route::current()->parameters() : [''] ;
            // $routeParameterFirst = head($routeParameters);

            $bannersGeneral = [];

            if ( in_array($routeAlias,$interalRoutesStatics) ){
                $bannersGeneral = Banner::query()
                    ->where('estado',1)
                    ->where(function ($query) {
                        $query->where('imagen', '!=', '')
                            ->orWhere('video', '!=', '');
                    })
                    ->where('ruta',$routeAlias)
                    ->get();
            }else{
                $bannersGeneral = Banner::query()
                    ->where('estado',1)
                    ->where('ruta',$routeParameterFirst)
                    ->get();
            }


            $view->with(compact('bannersGeneral'));


        });

        view()->composer(['web.*'],function($view){

            $seoGeneral = Seo::query()->first();
            $empresaGeneral = Empresa::query()->first();
            $monedaGeneral = Moneda::query()->find($empresaGeneral->idmoneda);
            $contactoGeneral = Contacto::query()->first();

            $categoriasGeneral = Categoria::query()
                ->where('estado', 1)
                ->whereNull('pariente')
                ->orderBy('idcategoria','desc')
                ->take(8)
                ->get();

            $menuGeneral = Menu::query()
                ->with(['submenus' ,'tipoRuta'])
                ->whereNull('pariente')
                ->orWhere('pariente',0)
                ->where('estado',1)
                ->orderBy('posicion')
                ->get();


            $popupsPaginas = Popup::query()
                ->where('estado',1)
                ->orderBy('orden','ASC')
                ->get();

            $marcasGeneral = Marca::query()
                ->where('estado',1)
                ->get();

            $countFavoritos = Favorito::getCountFavoritos();

            $contactoUrlWhatsappEmpresa = SocialTrait::whatsapp($contactoGeneral->celular, $contactoGeneral->whatsapp);

            $contactoRapidoGeneral = Asesor::query()
                ->where('estado',1)
                ->where('contacto_rapido',1)
                ->where('whatsapp',"<>","")
                ->whereNotNull('whatsapp')
                ->get();


            $terminosCondicionesGeneral = DB::table('terminos_condiciones')->first();
            $politicaPrivacidadGeneral = DB::table('politica_privacidad')->first();


            $view->with(compact(
                'seoGeneral',
                'empresaGeneral',
                'contactoGeneral',
                'categoriasGeneral',
                'menuGeneral',
                'marcasGeneral',
                'popupsPaginas',
                'contactoUrlWhatsappEmpresa',
                'countFavoritos',
                'contactoRapidoGeneral',
                'monedaGeneral',
                'terminosCondicionesGeneral',
                'politicaPrivacidadGeneral'
            ));

        });

        view()->composer(['panel.*'],function($view){

            $empresaGeneral = Empresa::query()->first();
            $monedaGeneral = Moneda::query()->find($empresaGeneral->idmoneda);
            $view->with(compact('empresaGeneral','monedaGeneral'));

        });

        view()->composer(['reportePdfSection.*'],function($view){

            $empresaGeneral = Empresa::query()->first();
            $view->with(compact('empresaGeneral'));

        });

        view()->composer(['mail.web.*','mail.panel.*'],function($view){

            $empresaGeneral = Empresa::query()->first();
            $contactoGeneral = Contacto::query()->first();

            $view->with(compact('empresaGeneral','contactoGeneral'));

        });





    }
}
