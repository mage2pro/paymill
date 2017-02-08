<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Dfe\Paymill\Settings as S;
use Paymill\Request as lRequest;
abstract class TestCase extends \Df\Core\TestCase {
	/**
	 * 2017-02-08
	 * @return lRequest
	 */
	final protected function r() {return new lRequest(S::s()->privateKey());}

	/**
	 * 2017-02-08
	 * [Paymill] How to create a test token from the server side (for unit testing)?
	 * https://mage2.pro/t/2680
	 * @return string
	 * An example of response: «tok_1febe8863f91d32e2f8a4734278f».
	 */
	final protected function token() {return
		dfa_deep(df_http_json('https://test-token.paymill.com/', [
			'account_expiry_month' => '12'
			,'account_expiry_year' => date('Y', strtotime('+1 year'))
			,'account_holder' => 'DMITRY FEDYUK'
			,'account_number' => '4111111111111111'
			,'channel_id' => S::s()->publicKey()
			,'transaction_mode' => 'CONNECTOR_TEST'
		]), 'transaction/identification/uniqueId')
	;}
}