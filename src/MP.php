<?php namespace Giorgiosaud\Mercadopago;

/**
 * MercadoPago Integration Library
 * Access MercadoPago for payments integration
 * 
 * @author hcasatti
 *
 */

class MP {

    const version = "0.5.2";

    protected $client_id;
    protected $client_secret;
    private $ll_access_token;
    private $access_data;
    protected $sandbox = FALSE;

    function __construct() {
        $i = func_num_args();

        if ($i > 2 || $i < 1) {
            throw new MercadoPagoException("Invalid arguments. Use CLIENT_ID and CLIENT SECRET, or ACCESS_TOKEN");
        }

        if ($i == 1) {
            $this->ll_access_token = func_get_arg(0);
        }

        if ($i == 2) {
            $this->client_id = func_get_arg(0);
            $this->client_secret = func_get_arg(1);
        }
    }

    public function sandbox_mode($enable = NULL) {
        if (!is_null($enable)) {
            $this->sandbox = $enable === TRUE;
        }

        return $this->sandbox;
    }

    /**
     * Get Access Token for API use
     */
    public function get_access_token() {
        if (isset ($this->ll_access_token) && !is_null($this->ll_access_token)) {
            return $this->ll_access_token;
        }

        $app_client_values = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials'
        );

        $access_data = MPRestClient::post(array(
            "uri" => "/oauth/token",
            "data" => $app_client_values,
            "headers" => array(
                "content-type" => "application/x-www-form-urlencoded"
            )
        ));

        if ($access_data["status"] != 200) {
            throw new MercadoPagoException ($access_data['response']['message'], $access_data['status']);
        }

        $this->access_data = $access_data['response'];

        return $this->access_data['access_token'];
    }

    /**
     * Get information for specific payment
     * @param int $id
     * @return array(json)
     */
    public function get_payment($id) {
        $uri_prefix = $this->sandbox ? "/sandbox" : "";

        $request = array(
            "uri" => $uri_prefix."/collections/notifications/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            )
        );

        $payment_info = MPRestClient::get($request);
        return $payment_info;
    }
    public function get_payment_info($id) {
        return $this->get_payment($id);
    }

    /**
     * Get information for specific authorized payment
     * @param id
     * @return array(json)
     */
    public function get_authorized_payment($id) {
        $request = array(
            "uri" => "/authorized_payments/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            )
        );

        $authorized_payment_info = MPRestClient::get($request);
        return $authorized_payment_info;
    }

    /**
     * Refund accredited payment
     * @param int $id
     * @return array(json)
     */
    public function refund_payment($id) {
        $request = array(
            "uri" => "/collections/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => array(
                "status" => "refunded"
            )
        );

        $response = MPRestClient::put($request);
        return $response;
    }

    /**
     * Cancel pending payment
     * @param int $id
     * @return array(json)
     */
    public function cancel_payment($id) {
        $request = array(
            "uri" => "/collections/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => array(
                "status" => "cancelled"
            )
        );

        $response = MPRestClient::put($request);
        return $response;
    }

    /**
     * Cancel preapproval payment
     * @param int $id
     * @return array(json)
     */
    public function cancel_preapproval_payment($id) {
        $request = array(
            "uri" => "/preapproval/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => array(
                "status" => "cancelled"
            )
        );

        $response = MPRestClient::put($request);
        return $response;
    }

    /**
     * Search payments according to filters, with pagination
     * @param array $filters
     * @param int $offset
     * @param int $limit
     * @return array(json)
     */
    public function search_payment($filters, $offset = 0, $limit = 0) {
        $filters["offset"] = $offset;
        $filters["limit"] = $limit;

        $uri_prefix = $this->sandbox ? "/sandbox" : "";

        $request = array(
            "uri" => $uri_prefix."/collections/search",
            "params" => array_merge ($filters, array(
                "access_token" => $this->get_access_token()
            ))
        );

        $collection_result = MPRestClient::get($request);
        return $collection_result;
    }

    /**
     * Create a checkout preference
     * @param array $preference
     * @return array(json)
     */
    public function create_preference($preference) {
        $request = array(
            "uri" => "/checkout/preferences",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => $preference
        );

        $preference_result = MPRestClient::post($request);
        return $preference_result;
    }

    /**
     * Update a checkout preference
     * @param string $id
     * @param array $preference
     * @return array(json)
     */
    public function update_preference($id, $preference) {
        $request = array(
            "uri" => "/checkout/preferences/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => $preference
        );

        $preference_result = MPRestClient::put($request);
        return $preference_result;
    }

    /**
     * Get a checkout preference
     * @param string $id
     * @return array(json)
     */
    public function get_preference($id) {
        $request = array(
            "uri" => "/checkout/preferences/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            )
        );

        $preference_result = MPRestClient::get($request);
        return $preference_result;
    }

    /**
     * Create a preapproval payment
     * @param array $preapproval_payment
     * @return array(json)
     */
    public function create_preapproval_payment($preapproval_payment) {
        $request = array(
            "uri" => "/preapproval",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => $preapproval_payment
        );

        $preapproval_payment_result = MPRestClient::post($request);
        return $preapproval_payment_result;
    }

    /**
     * Get a preapproval payment
     * @param string $id
     * @return array(json)
     */
    public function get_preapproval_payment($id) {
        $request = array(
            "uri" => "/preapproval/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            )
        );

        $preapproval_payment_result = MPRestClient::get($request);
        return $preapproval_payment_result;
    }

    /**
     * Update a preapproval payment
     * @param string $preapproval_payment, $id
     * @return array(json)
     */

    public function update_preapproval_payment($id, $preapproval_payment) {
        $request = array(
            "uri" => "/preapproval/{$id}",
            "params" => array(
                "access_token" => $this->get_access_token()
            ),
            "data" => $preapproval_payment
        );

        $preapproval_payment_result = MPRestClient::put($request);
        return $preapproval_payment_result;
    }

    /* Generic resource call methods */

    /**
     * Generic resource get
     * @param request
     * @param params (deprecated)
     * @param authenticate = true (deprecated)
     */
    public function get($request, $params = null, $authenticate = true) {
        if (is_string ($request)) {
            $request = array(
                "uri" => $request,
                "params" => $params,
                "authenticate" => $authenticate
            );
        }

        $request["params"] = isset ($request["params"]) && is_array ($request["params"]) ? $request["params"] : array();

        if (!isset ($request["authenticate"]) || $request["authenticate"] !== false) {
            $request["params"]["access_token"] = $this->get_access_token();
        }

        $result = MPRestClient::get($request);
        return $result;
    }

    /**
     * Generic resource post
     * @param request
     * @param data (deprecated)
     * @param params (deprecated)
     */
    public function post($request, $data = null, $params = null) {
        if (is_string ($request)) {
            $request = array(
                "uri" => $request,
                "data" => $data,
                "params" => $params
            );
        }

        $request["params"] = isset ($request["params"]) && is_array ($request["params"]) ? $request["params"] : array();

        if (!isset ($request["authenticate"]) || $request["authenticate"] !== false) {
            $request["params"]["access_token"] = $this->get_access_token();
        }

        $result = MPRestClient::post($request);
        return $result;
    }

    /**
     * Generic resource put
     * @param request
     * @param data (deprecated)
     * @param params (deprecated)
     */
    public function put($request, $data = null, $params = null) {
        if (is_string ($request)) {
            $request = array(
                "uri" => $request,
                "data" => $data,
                "params" => $params
            );
        }

        $request["params"] = isset ($request["params"]) && is_array ($request["params"]) ? $request["params"] : array();

        if (!isset ($request["authenticate"]) || $request["authenticate"] !== false) {
            $request["params"]["access_token"] = $this->get_access_token();
        }

        $result = MPRestClient::put($request);
        return $result;
    }

    /**
     * Generic resource delete
     * @param request
     * @param data (deprecated)
     * @param params (deprecated)
     */
    public function delete($request, $params = null) {
        if (is_string ($request)) {
            $request = array(
                "uri" => $request,
                "params" => $params
            );
        }

        $request["params"] = isset ($request["params"]) && is_array ($request["params"]) ? $request["params"] : array();

        if (!isset ($request["authenticate"]) || $request["authenticate"] !== false) {
            $request["params"]["access_token"] = $this->get_access_token();
        }

        $result = MPRestClient::delete($request);
        return $result;
    }

    /* **************************************************************************************** */

}

