<?php namespace Zonapro\MercadoPago\src\Facades;
use Illuminate\Support\Facades\Facade;

class Mercadopago extends Facade{
    protected static function  getFacadeAccessor() { return 'mercadopago'; }
}