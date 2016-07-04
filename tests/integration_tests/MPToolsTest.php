<?php
require_once './MPTools/MPTools.php';

class MPToolsTest extends PHPUnit_Framework_TestCase {
	private $test_data_path;
	private $test_payment_data_path;
	public function setUp() {
		$this->test_data_path = getcwd() . "/tests/test_data.json";
		$this->test_payment_data_path = getcwd() . "/tests/payment_data.json";
	}

	public function testMustCreateCustomPayment() {
		$country_config = json_decode(file_get_contents($this->test_data_path));
		$payment_config = json_decode(file_get_contents($this->test_payment_data_path));
		error_log(gettype($payment_config));
		error_log(json_encode($payment_config));
		$preference = $payment_config->standard_payment;
		$mptools = new MPTools($country_config['MLA']['client_id'], $country_config['MLA']['client_secret']);
		$payment_result = $mptools->createStandardPayment($preference, true);
		error_log("result: " . json_encode($payment_result));
		$this->assertNotNull($payment_result);
		//TODO: Fazer uma compra teste de cada tipo (standard, cartão e ticket) e copiar o error_log(obj) de pagamento enviado p/
		//usar como bootstrap do projeto. Fazer o mesmo para customers & cards nos testes de processo de criar/obter cartão e user 
	}

	public function testMustConvertObjectToPreference(){}

	public function tearDown() {}

}
