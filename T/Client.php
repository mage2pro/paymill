<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as iClient;
use Paymill\Models\Response\Client as oClient;
use Paymill\Request as API;
final class Client extends TestCase {
	/** @test */
	public function t00() {}

	/** 2017-02-11 */
	public function t01() {
		/** @var API $api */
		$api = $this->api();
		/** @var iClient $iClient */
		$iClient = new iClient;
		$iClient->setEmail('admin@mage2.pro');
		$iClient->setDescription('Дмитрий Федюк');
		/** @var oClient $oClient */
		$oClient = $api->create($iClient);
		echo "Response ID: {$oClient->getId()}\n";
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}

	/** 2017-02-11 */
	public function tDeleteAll() {array_map(function($id) {
		$this->api()->delete((new iClient)->setId($id));
	}, $this->ids());}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * https://developers.paymill.com/API/index#list-clients-
	 * @return string[]
	 */
	private function ids() {return array_column($this->api()->getAll(new iClient), 'id');}
}