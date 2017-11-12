<?php
namespace Dfe\Paymill\Facade;
use Dfe\Paymill\P\Charge as _Charge;
use Paymill\Models\Request\Preauthorization as iAuth;
use Paymill\Models\Request\Refund as iRefund;
use Paymill\Models\Request\Transaction as iCharge;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Preauthorization as oAuth;
use Paymill\Models\Response\Refund as oRefund;
use Paymill\Models\Response\Transaction as oCharge;
use Paymill\Request as API;
// 2017-02-10
/** @method \Dfe\Paymill\Method m() */
final class Charge extends \Df\StripeClone\Facade\Charge {
	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::capturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param string $id
	 * @param int|float $a
	 * The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 * @return oCharge
	 */
	function capturePreauthorized($id, $a) {
		$oCharge = $this->load($id); /** @var oCharge $oCharge */
		return $this->api()->create((new iCharge)
			// 2019-02-19 Для перестраховки от конверсионных погрешностей не используем $a.
			->setAmount($oCharge->getAmount())
			->setDescription($oCharge->getDescription())
			->setCurrency($oCharge->getCurrency())
			->setPreauthorization($oCharge->getPreauthorization()->getId())
		);
	}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 * @return oCharge
	 */
	function create(array $p) {
		$capture = $p[_Charge::K_CAPTURE]; /** @var bool $capture */
		// 2017-02-12
		// Приходится заводить эту переменную, потому что иначе интерпретатор PHP даёт сбой:
		// «syntax error, unexpected '->' (T_OBJECT_OPERATOR)».
		$i = $capture ? new iCharge : new iAuth; /** @var iCharge|iAuth $i */
		/** @var oCharge|oAuth $o */
		$o = $this->api()->create($i
			->setAmount($p[_Charge::K_AMOUNT])
			->setDescription($p[_Charge::K_DESCRIPTION])
			->setClient($p[_Charge::K_CUSTOMER_ID])
			->setCurrency($p[_Charge::K_CURRENCY])
			->setPayment($p[_Charge::K_CARD])
		);
		// 2017-02-12
		// Если $capture == false, то нужно явно инициализировать свойство payment,
		// иначе оно будет содержать не объект (банковскую карту), а лишь идентификатор этого объекта.
		return $capture ? $o : $o->getTransaction()->setPayment($o->getPayment());
	}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::id()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param oCharge $c
	 * @return string
	 */
	function id($c) {return $c->getId();}

	/**
	 * 2017-02-12
	 * Returns the path to the bank card information
	 * in a charge converted to an array by @see \Dfe\Paymill\Facade\O::toArray()
	 * https://developers.paymill.com/API/index#create-new-transaction-
	 * An example of Paymill response: https://mage2.pro/t/2682
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::pathToCard()
	 * @used-by \Df\StripeClone\Block\Info::cardData()
	 * @used-by \Df\StripeClone\Facade\Charge::cardData()
	 * @return string
	 */
	function pathToCard() {return 'payment';}

	/**
	 * 2017-02-10
	 * Метод должен вернуть библиотечный объект API платёжной системы.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::refund()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @param float $a
	 * В формате и валюте платёжной системы.
	 * Значение готово для применения в запросе API.
	 * @return oRefund
	 */
	function refund($id, $a) {return $this->api()->create((new iRefund)->setAmount($a)->setId($id));}

	/**
	 * 2017-02-10
	 * Метод должен вернуть библиотечный объект API платёжной системы.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @return oAuth
	 */
	function void($id) {return $this->api()->delete(
		(new iAuth)->setId($this->load($id)->getPreauthorization()->getId())
	);}

	/**
	 * 2017-02-11
	 * Идентификаторы банковских карт (в терминологии Paymill - «Payment») имеют вид
	 * «pay_ddcc9210289ede708c97eb67».
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::cardIdPrefix()
	 * @used-by \Df\StripeClone\Payer::tokenIsNew()
	 * @return string
	 */
	protected function cardIdPrefix() {return 'pay_';}

	/**
	 * 2017-02-11
	 * @return API
	 */
	private function api() {return $this->m()->api();}

	/**
	 * 2017-02-12
	 * @used-by capturePreauthorized()
	 * @used-by void()
	 * @param string $id
	 * @return oCharge
	 */
	private function load($id) {return $this->api()->getOne((new iCharge)->setId($id));}
}