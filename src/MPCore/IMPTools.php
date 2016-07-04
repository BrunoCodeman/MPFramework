<?php
namespace MercadoPago\MPFramework\MPTools;

interface IMPTools {
	public function createStandardPayment($preference, $sandbox);
	public function createCustomPayment($payment);
	public function createTicketPayment($payment);
	public function getPaymentDetails($paymentId);
	public function createCustomerCard($card);
	public function getCustomerCards($userId);
	public function createCustomer($user);
	public function getCustomer($userId);
	public function getCustomerID($userEmail);
	public function getPaymentMethods();
	public function getMessage($status);
	public function mapObject($jsonOrderObject);
	public function getCountry();

}