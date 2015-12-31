# mercadopagoLaravel
Este Paquete esta diseñado para integrar el SDK de Laravel con Mercadopago
## Para Instalarlo debes ejecutar el siguiente comando
```php
    composer require jorgelsaud/mercado-pago
````
### Luego debes utilizar el ServiceProvider que necesites para laravel 5 y anadirlo a config/app.php en el array de providers añade
```php
    jorgelsaud\MercadoPago\MercadoPagoServiceProvider::class
````
### Si Utilizas Laravel 4.2 usa este provider:
```php
    'jorgelsaud\MercadoPago\MercadoPagoServiceProviderL4',
````
#### ¡¡no lo he probado en versiones anteriores de Laravel!!
### y agregar esta linea al array aliases 
```php
    'Mercadopago' => 'jorgelsaud\Mercadopago\Facades\Mercadopago',
````
### Agrega a el archovp conf/services.php lo siguiente:
```php
	'mercadopago'=>[
	'CLIENT_ID'=>env('MERCADOPAGO_CLIENT_ID', ''),
	'CLIENT_SECRET'=>env('MERCADOPAGO_CLIENT_SECRET', ''),
	'SANDBOXMODE'=>env('MERCADOPAGO_MP_SANDBOXMODE', ''),
	]
````
### A tu archivo .env agrega los datos de el SDK de Mercadopago
```json
    MERCADOPAGO_CLIENT_ID=XXXXXXXXXXXXXX
    MERCADOPAGO_CLIENT_SECRET=YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY
````
### y selecciona el estado de prueba con el sanbox que describe Mercadopago en su SDK con esta linea en el .env
```json
    MERCADOPAGO_MP_SANDBOXMODE=false
````
# y ya puedes usar el alias Mercadopago como una clase de tu SDK Mercadopago