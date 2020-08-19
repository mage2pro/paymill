<?php
# 2017-02-08
namespace Dfe\Paymill\Test;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
final class Card extends CaseT {
	/** @test 2017-02-08 */
	function t00() {}

	/** 2017-02-08 */
	function t01() {
		/** @var API $api */
		$api = $this->api();
		/** @var oCard $oCard */
		$oCard = $api->create((new iCard)->setToken($this->token()));
		print_r("Response ID: {$oCard->getId()}\n");
		$this->showLastResponse();
	}
}