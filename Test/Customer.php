<?php
# 2017-02-11
namespace Dfe\Paymill\Test;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Client as oCustomer;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
final class Customer extends CaseT {
	/** @test */
	function t00() {}

	/** 2017-02-11 */
	function t01() {
		/** @var API $api */
		$api = $this->api();
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setEmail('admin@mage2.pro');
		$iCustomer->setDescription('Дмитрий Федюк');
		/** @var oCustomer $oCustomer */
		$oCustomer = $api->create($iCustomer);
		print_r("Response ID: {$oCustomer->getId()}\n");
		$this->showLastResponse();
	}

	/** 2017-02-11 */
	function t02_DeleteAll() {array_map(function($id) {
		$this->api()->delete((new iCustomer)->setId($id));
	}, $this->ids());}

	/** 2017-02-11 */
	function t03_GetById() {
		/** @var API $api */
		$api = $this->api();
		/** @var string $id */
		$id = 'client_cbe81b8bf830d7bbbb60';
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setId($id);
		/** @var oCustomer $oCustomer */
		$oCustomer = $api->getOne($iCustomer);
		array_map(function(oCard $oCard) {
			xdebug_break();
		}, $oCustomer->getPayment());
		$this->showLastResponse();
	}

	/**
	 * 2017-02-11
	 * @expectedException \Paymill\Services\PaymillException
	 */
	function t04_GetNonExistent() {
		/** @var API $api */
		$api = $this->api();
		/** @var string $id */
		$id = 'client_NON_EXISTENT';
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setId($id);
		$api->getOne($iCustomer);
	}

	/** 2017-02-11 */
	function t05_AddCard() {
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
	private function ids() {return array_column($this->api()->getAll(new iCustomer), 'id');}
}