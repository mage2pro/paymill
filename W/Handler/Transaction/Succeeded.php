<?php
namespace Dfe\Paymill\W\Handler\Transaction;
use \Df\StripeClone\W\Strategy\CapturePreauthorized as Strategy;
// 2017-02-14
// Оповещение «transaction.succeeded» приходит
// при выполнении операции «capture» из административного интерфейса Paymill.
// An example of this event: https://mage2.pro/t/2749
final class Succeeded extends \Df\StripeClone\W\Handler {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Handler::strategyC()
	 * @used-by \Df\StripeClone\W\Handler::_handle()
	 * @return string
	 */
	protected function strategyC() {return Strategy::class;}
}