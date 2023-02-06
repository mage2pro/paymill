<?php
# 2017-02-11
namespace Dfe\Paymill\Test;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Request\Transaction as iCharge;
use Paymill\Models\Response\Client as oCustomer;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Transaction as oCharge;
use Paymill\Request as lRequest;
final class Charge extends CaseT {
	/** @test */
	function t00():void {}

	/** 2017-02-11 */
	function t01():void {
		$api = $this->api(); /** @var lRequest $api */
		$iCustomer = new iCustomer; /** @var iCustomer $iCustomer */
		$iCustomer->setEmail('admin@mage2.pro');
		$iCustomer->setDescription('Дмитрий Федюк');
		$oCustomer = $api->create($iCustomer); /** @var oCustomer $oCustomer */
		$iCard = new iCard; /** @var iCard $iCard */
		$iCard->setClient($oCustomer->getId());
		$iCard->setToken($this->token());
		$oCard = $api->create($iCard); /** @var oCard $oCard */
		$iCharge = new iCharge; /** @var iCharge $iCharge */
		$iCharge->setAmount(100);
		$iCharge->setClient($oCustomer->getId());
		$iCharge->setCurrency('EUR');
		$iCharge->setPayment($oCard->getId());
		//$reqTrans->setToken($this->token());
		$oCharge = $api->create($iCharge); /** @var oCharge $oCharge */
		$this->showLastResponse();
	}

	/** 2017-02-11 */
	function t02_ListAll():void {print_r("Response data:\n" . df_json_encode($this->ids()));}

	/**
	 * 2017-02-11 Возвращает не все записи, а только часть.
	 * @return string[]
	 */
	private function ids():array {return array_column($this->api()->getAll(new iCharge), 'id');}
}