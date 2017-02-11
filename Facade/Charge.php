<?php
namespace Dfe\Paymill\Facade;
use Df\Sales\Model\Order\Payment as DfOP;
use Magento\Sales\Model\Order\Payment as OP;
use Paymill\Models\Response\Payment as C;
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
	public function capturePreauthorized($id) {return null;}

	/**
	 * 2017-02-11
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::card()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param C $c
	 * @return array(string => string)
	 */
	public function card($c) {return [
		// 2017-02-09
		// 2-символьный код: «DE»
		DfOP::COUNTRY => $c->getCountry()
		,OP::CC_EXP_MONTH => $c->getExpireMonth()
		,OP::CC_EXP_YEAR => $c->getExpireYear()
		,OP::CC_LAST_4 => $c->getLastFour()
		,OP::CC_OWNER => $c->getCardHolder()
		,OP::CC_TYPE => Card::translateType($c->getCardType())
	];}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 * @return C
	 */
	public function create(array $p) {
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
	public function id($c) {return $c->getId();}

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
	public function refund($id, $amount) {return null;}

	/**
	 * 2017-02-10
	 * Метод должен вернуть библиотечный объект API платёжной системы.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @return object
	 */
	public function void($id) {return null;}
}