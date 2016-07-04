<?php

namespace MercadoPago\MPFramework\MPTools;

use MercadoPago\MPFramework\MPTools\IMPTools;

class MPTools implements IMPTools {
	private $mp;
	private $config;
	private $accepted_status = array(201, 200);
	function __construct() {
		$this->baseDir = getcwd() . "//MPTools//";
		$this->config = json_decode(file_get_contents($this->baseDir . "mp_config.json"));
		$this->status_messages = json_decode(file_get_contents($this->baseDir . "status_messages.json"));

		$num_args = func_num_args();
		if ($num_args == 2) {
			$this->mp = new MP(func_get_arg(0), func_get_arg(1));
		}elseif($num_args == 1) {
			$this->mp = new MP(func_get_args(0));
		} else {
			throw new Exception("Error creating MPTools: Invalid credentials", 1);
		}
	}
	public function getSdk()
	{
		return $this->mp;
	}
	public function createStandardPayment($preference, $sandbox) {
		$after_process = array('status' => 0, 'message' => "");
		if (strpos($preference->payer->email, '@testuser.com') === false) {
			$preference->sponsor_id = $this->config['sponsors']['country'];
		}
		try
		{
			$this->mp->sandbox_mode($sandbox);
			$preferenceResult = $this->mp->create_preference($preference);
			$after_process['status'] = $preferenceResult['status'];
			$after_process['message'] = $this->getMessage($preferenceResult['status']);
			return $after_process;
		} catch (Exception $e) {
			$after_process['status'] = 500;
			$after_process['message'] = $e->getMessage();
			return $after_process;
		}
	}

	public function createCustomPayment($payment) {
		try {
			if (strpos($preference['payer']['email'], '@testuser.com') === false) {
				$preference["sponsor_id"] = $this->config['country'];
			}

			$payment_json = json_decode($payment_data);
			$accepted_status = array('approved', "in_process");
			$payment_response = $this->mp->create_payment($payment_json);
			$json_response = array('status' => null, 'message' => null);

			if (in_array($payment_response['response']['status'], $accepted_status)) {
				$json_response['status'] = $payment_response['response']['status'];
			} else {
				$json_response['status'] = $payment_response['response']['status_detail'];
			}
			return $json_response;
		} catch (Exception $e) {
			echo json_encode(array("status" => $e->getCode(), "message" => $e->getMessage()));
		}
	}

	public function createTicketPayment($payment)
	{
		return $this->createCustomPayment($payment);
	}

	public function getPaymentDetails($paymentId)
	{
		return $this->mp->get_payment_info($paymentId);
	}

	public function createCustomerCard($cardToken, $customerId) {
		$card = $his->mp->post("/v1/customers/" . $customerId . "/cards", array("token" => $token));
		return $card;
	}
	public function getCustomerCards($userId) {
		$retorno = null;
		$cards = $this->mp->get("/v1/customers/" . $userId . "/cards");
		if (array_key_exists("response", $cards) && sizeof($cards["response"]) > 0) {
			$retorno = $cards["response"];
		}
		return $retorno;
	}

	public function createCustomer($userEmail) {
			$customer = array('email' => $userEmail);
			$uri = '/v1/customers/';
			$response = $this->mp->post($uri, $customer);
			return $response;
	}

	public function getCustomer($userId) 
	{

	}
	
	public function getCustomerID($userEmail){
		$customer = array('email' => $userEmail);
		$search_uri = "/v1/customers/search";
		$response = $this->mp->get($search_uri, $customer);
		$has_results_key = array_key_exists("results", $response["response"]);
		$has_results_values = sizeof($response["response"]["results"]) > 0;
		return ($has_results_key && $has_results_values ) ?
		$response["response"]["results"][0]["id"] : $this->createCustomer($userEmail)["response"]["id"];
	}
	
	public function getPaymentMethods($country)
	{

	}
	public function getMessage($status) {}
	public function mapObject($jsonOrderObject)
	{
		$mapper = json_decode(file_get_contents($this->baseDir . "dataMapper.json"));
		$mappedObject = array('' => "" );

		foreach ($mapper as $key => $value) {
			$mappedObject[$key] = eval('return $jsonOrderObject' . $value . ';');
		}

	}

}