<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Payment as iPayment;
use Paymill\Models\Response\Payment as oPayment;
use Paymill\Request as API;
final class Charge extends TestCase {
	/** @test 2017-02-08 */
	public function t00() {}

	/** 2017-02-08 */
	public function t01() {
		/** @var API $api */
		$api = $this->api();
		/** @var oPayment $oPayment */
		$oPayment = $api->create((new iPayment)->setToken($this->token()));
		echo "Response ID: {$oPayment->getId()}\n";
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}
}