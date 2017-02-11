<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as iClient;
use Paymill\Models\Request\Payment as iPayment;
use Paymill\Models\Request\Transaction as iTrans;
use Paymill\Models\Response\Client as oClient;
use Paymill\Models\Response\Payment as oPayment;
use Paymill\Models\Response\Transaction as oTrans;
use Paymill\Request as lRequest;
final class Transaction extends TestCase {
	/** 2017-02-11 */
	public function t01() {
		/** @var lRequest $api */
		$api = $this->api();
		/** @var iClient $iClient */
		$iClient = new iClient;
		$iClient->setEmail('admin@mage2.pro');
		$iClient->setDescription('Дмитрий Федюк');
		/** @var oClient $oClient */
		$oClient = $api->create($iClient);
		/** @var iTrans $iTrans */
		$iTrans = new iTrans;
		$iTrans->setAmount(100);
		$iTrans->setClient($oClient->getId());
		$iTrans->setCurrency('EUR');
		//$reqTrans->setToken($this->token());
		/** @var oTrans $oTrans */
		$oTrans = $api->create($iTrans);
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}

	/** 2017-02-11 */
	public function t02_ListAll() {echo "Response data:\n" . df_json_encode_pretty($this->ids());}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * @return string[]
	 */
	private function ids() {return array_column($this->api()->getAll(new iTrans), 'id');}
}