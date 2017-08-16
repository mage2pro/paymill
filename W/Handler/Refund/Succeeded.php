<?php
namespace Dfe\Paymill\W\Handler\Refund;
/**
 * 2017-02-14
 * 2017-08-16
 * We get the `refund.succeeded` event when the merchant has just refunded a payment from his Paymill backend.
 * An example of the event's data: https://mage2.pro/t/topic/2750
 * @method \Dfe\Paymill\W\Event e()
 */
final class Succeeded extends \Df\Payment\W\Handler implements \Df\Payment\W\IRefund {
	/**
	 * 2017-02-14
	 * В валюте заказа (платежа), в формате платёжной системы (копейках).
	 * @override
	 * @see \Df\Payment\W\IRefund::amount()
	 * @used-by \Df\Payment\W\Strategy\Refund::_handle()
	 * @return int
	 */
	function amount() {return $this->e()->ro('amount');}

	/**
	 * 2017-02-14
	 * Метод должен вернуть идентификатор операции (не платежа!) в платёжной системе.
	 * Он нужен нам для избежания обработки оповещений о возвратах, инициированных нами же
	 * из административной части Magento: @see \Df\StripeClone\Method::_refund()
	 * Это должен быть тот же самый идентификатор,
	 * который возвращает @see \Dfe\Paymill\Facade\Refund::transId()
	 * Пример результата: «refund_2c9cd9a13357f2454522»
	 * @override
	 * @see \Df\Payment\W\IRefund::eTransId()
	 * @used-by \Df\Payment\W\Strategy\Refund::_handle()
	 * @return string
	 */
	function eTransId() {return $this->e()->ro('id');}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\Payment\W\Handler::strategyC()
	 * @used-by \Df\Payment\W\Handler::handle()
	 * @return string
	 */
	protected function strategyC() {return \Df\Payment\W\Strategy\Refund::class;}
}