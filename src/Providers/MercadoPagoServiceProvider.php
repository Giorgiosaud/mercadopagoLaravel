<?php namespace jorgelsaud\MercadoPago\Providers;

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
        App::bind('mercadopago', function ()
        {
            return new Mercadopago(env('CLIENT_ID'), env('CLIENT_SECRET'), env('MP_SANDBOXMODE'));
        });
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
