<?php
# 2017-02-08
namespace Dfe\Paymill\Test;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
final class Card extends CaseT {
	/** 2017-02-08 @test */
	function t00():void {}

	/** 2017-02-08 */
	function t01():void {
		$api = $this->api(); /** @var API $api */
		$oCard = $api->create((new iCard)->setToken($this->token())); /** @var oCard $oCard */
		print_r("Response ID: {$oCard->getId()}\n");
		$this->showLastResponse();
	}
}