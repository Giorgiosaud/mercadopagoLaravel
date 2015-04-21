<?php
Route::get('/mpPayment','jorgelsaud\Mercadopago\controllers\MercadopagoController@index');
Route::push('/mpPayment','jorgelsaud\Mercadopago\controllers\MercadopagoController@save');
