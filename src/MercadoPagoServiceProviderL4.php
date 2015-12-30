<?php namespace jorgelsaud\MercadoPago;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use jorgelsaud\Mercadopago\Mercadopago;

class MercadoPagoServiceProviderL4 extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        App::bind('mercadopago', function () {
            return new Mercadopago(Config::get('services.mercadopago.CLIENT_ID'), Config::get('services.mercadopago.CLIENT_SECRET'), Config::get('services.mercadopago.SANDBOXMODE'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
