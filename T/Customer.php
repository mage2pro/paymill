<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Client as oCustomer;
use Paymill\Request as API;
final class Customer extends TestCase {
	/** @test */
	public function t00() {}

	/** 2017-02-11 */
	public function t01() {
		/** @var API $api */
		$api = $this->api();
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setEmail('admin@mage2.pro');
		$iCustomer->setDescription('Дмитрий Федюк');
		/** @var oCustomer $oCustomer */
		$oCustomer = $api->create($iCustomer);
		echo "Response ID: {$oCustomer->getId()}\n";
		$this->showLastResponse();
	}

	/** 2017-02-11 */
	public function t02_DeleteAll() {array_map(function($id) {
		$this->api()->delete((new iCustomer)->setId($id));
	}, $this->ids());}

	/** 2017-02-11 */
	public function t03_GetById() {
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
	 * @test 2017-02-11
	 * @expectedException \Paymill\Services\PaymillException
	 */
	public function t04_GetNonExistent() {
		/** @var API $api */
		$api = $this->api();
		/** @var string $id */
		$id = 'client_NON_EXISTENT';
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setId($id);
		$api->getOne($iCustomer);
	}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * https://developers.paymill.com/API/index#list-clients-
	 * @return string[]
	 */
	private function ids() {return array_column($this->api()->getAll(new iCustomer), 'id');}
}