<?php
namespace Dfe\Paymill\Webhook\Transaction;
use Df\StripeClone\WebhookStrategy\Charge\Captured as Strategy;
use Dfe\Paymill\Method as M;
// 2017-02-14
// Оповещение «transaction.succeeded» приходит
// при выполнении операции «capture» из административного интерфейса Paymill.
// An example of this event: https://mage2.pro/t/2749
final class Succeeded extends \Dfe\Paymill\Webhook {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\Webhook::currentTransactionType()
	 * @used-by \Df\StripeClone\Webhook::id()
	 * @used-by \Df\StripeClone\WebhookStrategy::currentTransactionType()
	 * @return string
	 */
	function currentTransactionType() {return M::T_CAPTURE;}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\Webhook::parentTransactionType()
	 * @used-by \Df\StripeClone\Webhook::adaptParentId()
	 * @return string
	 */
	protected function parentTransactionType() {return M::T_AUTHORIZE;}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\Webhook::strategyC()
	 * @used-by \Df\StripeClone\Webhook::_handle()
	 * @return string
	 */
	protected function strategyC() {return Strategy::class;}
}