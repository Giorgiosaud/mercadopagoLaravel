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
        $this->app['mercadopago'] = $this->app->share(function($app)
        {
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
