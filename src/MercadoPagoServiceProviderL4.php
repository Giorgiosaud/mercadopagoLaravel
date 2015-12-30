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
            return new Mercadopago(config('mercadopago.MERCADOPAGO_CLIENT_ID'), config('mercadopago.MERCADOPAGO_CLIENT_SECRET'), config('mercadopago.MERCADOPAGO_MP_SANDBOXMODE'));
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
