<?php
namespace Dfe\Paymill\T;
use Dfe\Paymill\Settings as S;
/**
 * 2017-02-08
 * https://github.com/paymill/paymill-php
 * [Paymill] How to create a test token from the server side (for unit testing)?
 * https://mage2.pro/t/2680
 * @see \Paymill\Tests\Integration\IntegrationBase::createToken()
 * https://github.com/paymill/paymill-php/blob/v4.4.1/tests/Integration/IntegrationBase.php#L37-L54
 */
class Token extends \Df\Core\TestCase {
	/**
	 * @test
	 * 2017-02-08
	 * An example of response: «tok_1febe8863f91d32e2f8a4734278f».
	 */
	public function t01() {
		/** @var array(string => mixed) $response */
		$response = df_http_json('https://test-token.paymill.com/', [
			'account_expiry_month' => '12'
			,'account_expiry_year' => date('Y', strtotime('+1 year'))
			,'account_holder' => 'DMITRY FEDYUK'
			,'account_number' => '4111111111111111'
			,'channel_id' => S::s()->publicKey()
			,'transaction_mode' => 'CONNECTOR_TEST'
		]);
		echo dfa_deep($response, 'transaction/identification/uniqueId');
	}
}