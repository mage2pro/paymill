<?php
namespace Dfe\Paymill\T;
use Paymill\Request as API;
/**
 * 2017-02-08
 * @see \Dfe\Paymill\T\Auth
 * @see \Dfe\Paymill\T\Card
 * @see \Dfe\Paymill\T\Charge
 * @see \Dfe\Paymill\T\Customer
 * @method \Dfe\Paymill\Settings s()
 */
abstract class CaseT extends \Df\Core\TestCase {
	/**
	 * 2017-02-08
	 * @return API
	 */
	final protected function api() {return dfc($this, function() {return new API($this->s()->privateKey());});}

	/** 2017-02-11 */
	final protected function showLastResponse() {
		print_r("Response data:\n" . df_json_encode($this->api()->getLastResponse()))
	;}

	/**
	 * 2017-02-08
	 * [Paymill] How to create a test token from the server side (for unit testing)?
	 * https://mage2.pro/t/2680
	 * @param string $number [optional]
	 * [Paymill] The test bank cards: https://mage2.pro/t/2639
	 * @return string
	 * An example of response: «tok_1febe8863f91d32e2f8a4734278f».
	 */
	final protected function token($number = '4111111111111111') {return
		dfa_deep(df_http_json('https://test-token.paymill.com/', [
			'account_expiry_month' => '12'
			,'account_expiry_year' => date('Y', strtotime('+1 year'))
			,'account_holder' => 'DMITRY FEDYUK'
			,'account_number' => $number
			,'channel_id' => $this->s()->publicKey()
			,'transaction_mode' => 'CONNECTOR_TEST'
		]), 'transaction/identification/uniqueId')
	;}
}