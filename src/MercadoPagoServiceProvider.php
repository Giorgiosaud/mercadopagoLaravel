<?php namespace jorgelsaud\MercadoPago;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use jorgelsaud\Mercadopago\Mercadopago;

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
        App::bind('mercadopago', function ()
        {
            return new Mercadopago(config('mercadopago.CLIENT_ID'), config('mercadopago.CLIENT_SECRET'), config('mercadopago.MP_SANDBOXMODE'));
        });

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
