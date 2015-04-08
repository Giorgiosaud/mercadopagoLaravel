<?php namespace jorgelsaud\MercadoPago\src\Facades;
use Illuminate\Support\Facades\Facade;

class Mercadopago extends Facade{
    protected static function  getFacadeAccessor() { return 'mercadopago'; }
}