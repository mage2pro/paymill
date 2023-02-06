<?php
namespace Dfe\Paymill\Test;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Client as oCustomer;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
# 2017-02-11
final class Customer extends CaseT {
	/** @test */
	function t00():void {}

	/** 2017-02-11 */
	function t01():void {
		$api = $this->api(); /** @var API $api */
		$iCustomer = new iCustomer; /** @var iCustomer $iCustomer */
		$iCustomer->setEmail('admin@mage2.pro');
		$iCustomer->setDescription('Дмитрий Федюк');
		$oCustomer = $api->create($iCustomer); /** @var oCustomer $oCustomer */
		print_r("Response ID: {$oCustomer->getId()}\n");
		$this->showLastResponse();
	}

	/** 2017-02-11 */
	function t02_DeleteAll():void {array_map(function($id) {$this->api()->delete((new iCustomer)->setId($id));}, $this->ids());}

	/** 2017-02-11 */
	function t03_GetById():void {
		$api = $this->api(); /** @var API $api */
		$id = 'client_cbe81b8bf830d7bbbb60'; /** @var string $id */
		$iCustomer = new iCustomer; /** @var iCustomer $iCustomer */
		$iCustomer->setId($id);
		$oCustomer = $api->getOne($iCustomer); /** @var oCustomer $oCustomer */
		array_map(function(oCard $oCard) {
			xdebug_break();
		}, $oCustomer->getPayment());
		$this->showLastResponse();
	}

	/**
	 * 2017-02-11
	 * @expectedException \Paymill\Services\PaymillException
	 */
	function t04_GetNonExistent():void {
		$api = $this->api(); /** @var API $api */
		$id = 'client_NON_EXISTENT'; /** @var string $id */
		$iCustomer = new iCustomer; /** @var iCustomer $iCustomer */
		$iCustomer->setId($id);
		$api->getOne($iCustomer);
	}

	/** 2017-02-11 */
	function t05_AddCard():void {
		/** @var API $api */
		$api = $this->api();
		/** @var string $id */
		$id = 'client_cbe81b8bf830d7bbbb60';
		/** @var iCard $iCard */
		$iCard = new iCard;
		$iCard->setClient($id);
		# 2017-02-11
		# [Paymill] The test bank cards: https://mage2.pro/t/2639
		$iCard->setToken($this->token('5500000000000004'));
		/** @var oCard $oCard */
		$oCard = $api->create($iCard);
		$this->showLastResponse();
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setId($id);
		/** @var oCustomer $oCustomer */
		$oCustomer = $api->getOne($iCustomer);
		$this->showLastResponse();
	}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * https://developers.paymill.com/API/index#list-clients-
	 * @return string[]
	 */
	private function ids():array {return array_column($this->api()->getAll(new iCustomer), 'id');}
}