<?php
namespace Dfe\Paymill\Facade;
use Dfe\Paymill\Charge as _Charge;
use Paymill\Models\Request\Preauthorization as iAuth;
use Paymill\Models\Request\Transaction as iCharge;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Preauthorization as oAuth;
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
	 * @return oCharge
	 */
	function capturePreauthorized($id) {return null;}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 * @return oCharge|oAuth
	 * Класс результата зависит от входного параметра capture.
	 */
	function create(array $p) {return $this->api()->create(
		($p[_Charge::K_CAPTURE] ? new iCharge : new iAuth)
			->setAmount($p[_Charge::K_AMOUNT])
			->setDescription($p[_Charge::K_DESCRIPTION])
			->setClient($p[_Charge::K_CUSTOMER])
			->setCurrency($p[_Charge::K_CURRENCY])
			->setPayment($p[_Charge::K_CARD])
	);}

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
	 * @used-by \Df\StripeClone\Block\Info::prepare()
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
	 * @param float $amount
	 * В формате и валюте платёжной системы.
	 * Значение готово для применения в запросе API.
	 * @return object
	 */
	function refund($id, $amount) {return null;}

	/**
	 * 2017-02-10
	 * Метод должен вернуть библиотечный объект API платёжной системы.
	 * 2017-02-12
	 * В отличие от других ПС, а данном случае $id — это идентификатор не charge,
	 * а специального объекта preauthorization.
	 * Пример: «preauth_4dfe6453fd15d1628a99».
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @return oAuth
	 */
	function void($id) {return $this->api()->delete((new iAuth)->setId($id));}

	/**
	 * 2017-02-11
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::cardData()
	 * @used-by \Df\StripeClone\Facade\Charge::card()
	 * @param oCharge $c
	 * @return oCard
	 * @see \Dfe\Paymill\Facade\Customer::cardsData()
	 */
	protected function cardData($c) {return $c->getPayment();}

	/**
	 * 2017-02-11
	 * @return API
	 */
	private function api() {return $this->m()->api();}
}