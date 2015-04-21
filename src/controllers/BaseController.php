<?php /**
 * Created by jorgelsaud.
 * User: jorgelsaud
 * Date: 21/4/15
 * Time: 2:15
 */
namespace jorgelsaud\MercadoPago\Controllers;


use Illuminate\Routing\Controller;
use jorgelsaud\Mercadopago\Mercadopago;

class BaseController extends Controller {


    /**
     * @var Mercadopago
     */
    private $mercadopago;

    function __construct(Mercadopago $mercadopago)
    {
        $this->mercadopago = $mercadopago;
    }
}