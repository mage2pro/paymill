<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as iCustomer;
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
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}

	/** 2017-02-11 */
	public function tDeleteAll() {array_map(function($id) {
		$this->api()->delete((new iCustomer)->setId($id));
	}, $this->ids());}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * https://developers.paymill.com/API/index#list-clients-
	 * @return string[]
	 */
	private function ids() {return array_column($this->api()->getAll(new iCustomer), 'id');}
}