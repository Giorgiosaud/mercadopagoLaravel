<?php /**
 * Created by jorgelsaud.
 * User: jorgelsaud
 * Date: 21/4/15
 * Time: 7:01
 */
namespace Giorgiosaud\Mercadopago\controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MercadopagoController extends Controller {

    public function verificarPagoyGuardar(Request $request)
    {
        $d= Mercadopago::get_payment($request->input('collection_id'));
        dd($d);
        //return view('MercadoPago::list');
    }

    public function save(Request $request)
    {
        dd($request->all());
        return view('MercadoPago::list');

    }

}