<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Dfe\Paymill\Settings as S;
use Paymill\Request as API;
abstract class TestCase extends \Df\Core\TestCase {
	/**
	 * 2017-02-08
	 * @return API
	 */
	final protected function api() {return dfc($this, function() {return new API(S::s()->privateKey());});}

	/** 2017-02-11 */
	final protected function showLastResponse() {
		echo "Response data:\n" . df_json_encode_pretty($this->api()->getLastResponse())
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
			,'channel_id' => S::s()->publicKey()
			,'transaction_mode' => 'CONNECTOR_TEST'
		]), 'transaction/identification/uniqueId')
	;}
}