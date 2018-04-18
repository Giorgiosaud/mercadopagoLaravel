<?php
/**
 * Created by PhpStorm.
 * User: jorgelsaud
 * Date: 05-02-18
 * Time: 15:57
 */

namespace Giorgiosaud\Mercadopago;


use Exception;

class MercadoPagoException extends Exception {
    public function __construct($message, $code = 500, Exception $previous = null) {
        // Default code 500
        parent::__construct($message, $code, $previous);
    }
}