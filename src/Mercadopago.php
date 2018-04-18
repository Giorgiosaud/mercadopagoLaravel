<?php namespace Giorgiosaud\Mercadopago;

/**
 * MercadoPago Integration Library
 * Access MercadoPago for payments integration
 *
 * @author hcasatti
 *
 */

/**
 * Class Mercadopago
 * @package Giorgiosaud\Mercadopago
 */
/**
 * Class Mercadopago
 * @package Giorgiosaud\Mercadopago
 */
/**
 * Class Mercadopago
 * @package Giorgiosaud\Mercadopago
 */
class Mercadopago extends MP {

    /**
     *
     */
    const version = "0.5.2";

    /**
     * @var mixed
     */
    protected $client_id;
    /**
     * @var mixed
     */
    protected $client_secret;
    /**
     * @var mixed
     */
    private $ll_access_token;
    /**
     * @var
     */
    private $access_data;
    /**
     * @var bool|mixed
     */
    protected $sandbox = false;

    /**
     * Mercadopago constructor.
     */
    function __construct($client_id,$client_secret,$sandbox)
    {
            $this->client_id = $client_id;
            $this->client_secret = $client_secret;
            $this->sandbox = $sandbox;
    }

    /**
     * @param $preference
     * @return mixed
     */
    public function create_preference_and_get_url($preference_data){


        $sbk = 'init_point';
        if ($this->sandbox)
        {
            $sbk = 'sandbox_init_point';
        }
        $preference = $this->create_preference($preference_data);
        return $preference["response"][$sbk];
    }

}

