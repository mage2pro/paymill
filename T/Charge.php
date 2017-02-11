<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Request\Transaction as iCharge;
use Paymill\Models\Response\Client as oCustomer;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Transaction as oCharge;
use Paymill\Request as lRequest;
final class Charge extends TestCase {
	/** @test */
	public function t00() {}

	/** 2017-02-11 */
	public function t01() {
		/** @var lRequest $api */
		$api = $this->api();
		/** @var iCustomer $iCustomer */
		$iCustomer = new iCustomer;
		$iCustomer->setEmail('admin@mage2.pro');
		$iCustomer->setDescription('Дмитрий Федюк');
		/** @var oCustomer $oCustomer */
		$oCustomer = $api->create($iCustomer);
		/** @var iCard $iCard */
		$iCard = new iCard;
		$iCard->setClient($oCustomer->getId());
		$iCard->setToken($this->token());
		/** @var oCard $oCard */
		$oCard = $api->create($iCard);
		/** @var iCharge $iCharge */
		$iCharge = new iCharge;
		$iCharge->setAmount(100);
		$iCharge->setClient($oCustomer->getId());
		$iCharge->setCurrency('EUR');
		$iCharge->setPayment($oCard->getId());
		//$reqTrans->setToken($this->token());
		/** @var oCharge $oCharge */
		$oCharge = $api->create($iCharge);
		$this->showLastResponse();
	}

	/** 2017-02-11 */
	public function t02_ListAll() {echo "Response data:\n" . df_json_encode_pretty($this->ids());}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * @return string[]
	 */
	private function ids() {return array_column($this->api()->getAll(new iCharge), 'id');}
}