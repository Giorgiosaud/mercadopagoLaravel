<?php namespace Giorgiosaud\MercadoPago;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Giorgiosaud\Mercadopago\Mercadopago;

class MercadoPagoServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/migrations/' => database_path('/migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__.'/config/mercadopago.php' => config_path('mercadopago.php')
        ], 'config');
        $this->loadViewsFrom(__DIR__.'/Views', 'MercadoPago');
        App::bind('mercadopago', function ()
        {
            return new Mercadopago(config('services.mercadopago.CLIENT_ID'), config('services.mercadopago.CLIENT_SECRET'), config('services.mercadopago.SANDBOXMODE'));
        });
        //$routeConfig = [
        //    'namespace' => 'jorgelsaud\MercadoPago\Controllers',
        //    'prefix' => $this->app['config']->get('debugbar.route_prefix'),
        //];
        include __DIR__.'/routes/routes.php';

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public
    function register()
    {
        //
    }

}
