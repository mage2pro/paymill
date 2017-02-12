<?php
namespace Dfe\Paymill\Facade;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Transaction as C;
// 2017-02-10
/** @method \Dfe\Paymill\Method m() */
final class Charge extends \Df\StripeClone\Facade\Charge {
	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::capturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param string $id
	 * @return C
	 */
	function capturePreauthorized($id) {return null;}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 * @return C
	 */
	function create(array $p) {
		return null;
	}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::id()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param C $c
	 * @return string
	 */
	function id($c) {return $c->getId();}

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
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @return object
	 */
	function void($id) {return null;}

	/**
	 * 2017-02-11
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::cardData()
	 * @used-by \Df\StripeClone\Facade\Charge::card()
	 * @param C $c
	 * @return oCard
	 * @see \Dfe\Paymill\Facade\Customer::cardsData()
	 */
	protected function cardData($c) {return $c->getPayment();}
}