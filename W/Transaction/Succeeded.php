<?php
namespace Dfe\Paymill\W\Handler\Transaction;
use Df\StripeClone\W\Strategy\Charge\Captured as Strategy;
use Dfe\Paymill\Method as M;
// 2017-02-14
// Оповещение «transaction.succeeded» приходит
// при выполнении операции «capture» из административного интерфейса Paymill.
// An example of this event: https://mage2.pro/t/2749
final class Succeeded extends \Dfe\Paymill\W\Handler {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Handler::currentTransactionType()
	 * @used-by \Df\StripeClone\W\Handler::id()
	 * @used-by \Df\StripeClone\W\Strategy::currentTransactionType()
	 * @return string
	 */
	function currentTransactionType() {return M::T_CAPTURE;}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Handler::parentTransactionType()
	 * @used-by \Df\StripeClone\W\Handler::adaptParentId()
	 * @return string
	 */
	protected function parentTransactionType() {return M::T_AUTHORIZE;}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Handler::strategyC()
	 * @used-by \Df\StripeClone\W\Handler::_handle()
	 * @return string
	 */
	protected function strategyC() {return Strategy::class;}
}