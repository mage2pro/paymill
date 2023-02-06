<?php
namespace Dfe\Paymill\W\Event\Transaction;
# 2017-03-15
final class Succeeded extends \Dfe\Paymill\W\Event {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\Payment\W\Event::ttCurrent()
	 * @used-by \Df\StripeClone\W\Nav::id()
	 * @used-by \Df\Payment\W\Strategy\ConfirmPending::_handle()
	 */
	function ttCurrent():string {return self::T_CAPTURE;}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Event::ttParent()
	 * @used-by \Df\StripeClone\W\Nav::pidAdapt()
	 */
	function ttParent():string {return self::T_AUTHORIZE;}
}