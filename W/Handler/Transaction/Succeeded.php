<?php
namespace Dfe\Paymill\W\Handler\Transaction;
# 2017-02-14
# 2017-08-16
# We get the `transaction.succeeded` event
# when the merchant has just captured a preauthorized payment from his Paymill backend.
# An example of the event's data: https://mage2.pro/t/2749
final class Succeeded extends \Df\Payment\W\Handler {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\Payment\W\Handler::strategyC()
	 * @used-by \Df\Payment\W\Handler::handle()
	 * @return string
	 */
	protected function strategyC() {return \Df\Payment\W\Strategy\CapturePreauthorized::class;}
}