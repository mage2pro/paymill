<?php
namespace Dfe\Paymill\Facade;
// 2017-02-10
/** @method \Dfe\Paymill\Method m() */
final class Refund extends \Df\StripeClone\Facade\Refund {
	/**
	 * 2017-02-10
	 * Метод должен вернуть идентификатор операции (не платежа!) в платёжной системе.
	 * Мы записываем его в БД и затем при обработке оповещений от платёжной системы
	 * смотрим, не было ли это оповещение инициировано нашей же операцией,
	 * и если было, то не обрабатываем его повторно.
	 * 2017-02-14
	 * Замечание №1
	 * Этот же идентификатор должен возвращать @see \Dfe\Paymill\Webhook\Refund\Succeeded::eTransId()
	 * Замечание №2
	 * Пример результата: «refund_2c9cd9a13357f2454522»
	 * [Paymill] An example of a refund response: https://mage2.pro/t/2751
	 * @override
	 * @see \Df\StripeClone\Facade\Refund::transId()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param object $r
	 * @return string
	 */
	function transId($r) {return $r->getId();}
}