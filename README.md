# mercadopagoLaravel
Este Paquete esta diseñado para integrar el SDK de Laravel con Mercadopago
## Para Instalarlo debes ejecutar el siguiente comando
    composer require jorgelsaud/mercado-pago
### Luego debes utilizar el ServiceProvider que necesites para laravel 5 y anadirlo a config/app.php en el array de providers añade
    jorgelsaud\MercadoPago\MercadoPagoServiceProvider::class
### y agregar esta linea al array aliases 
    'Mercadopago' => 'jorgelsaud\Mercadopago\Facades\Mercadopago',

### Agrega a el archovp conf/services.php lo siguiente:
	'mercadopago'=>[
	'CLIENT_ID'=>env('MERCADOPAGO_CLIENT_ID', ''),
	'CLIENT_SECRET'=>env('MERCADOPAGO_CLIENT_SECRET', ''),
	'SANDBOXMODE'=>env('MERCADOPAGO_MP_SANDBOXMODE', ''),
	]
### A tu archivo .env agrega los datos de el SDK de Mercadopago
    MERCADOPAGO_CLIENT_ID=XXXXXXXXXXXXXX
    MERCADOPAGO_CLIENT_SECRET=YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY
### y selecciona el estado de prueba con el sanbox que describe Mercadopago en su SDK con esta linea en el .env
    MERCADOPAGO_MP_SANDBOXMODE=false
# y ya puedes usar el alias Mercadopago como una clase de tu SDK Mercadopago