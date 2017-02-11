<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
final class Card extends TestCase {
	/** @test 2017-02-08 */
	public function t00() {}

	/** 2017-02-08 */
	public function t01() {
		/** @var API $api */
		$api = $this->api();
		/** @var oCard $oCard */
		$oCard = $api->create((new iCard)->setToken($this->token()));
		echo "Response ID: {$oCard->getId()}\n";
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}
}