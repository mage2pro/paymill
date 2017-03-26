<?php
namespace Dfe\Paymill\W\Event\Transaction;
// 2017-03-15
final class Succeeded extends \Dfe\Paymill\W\Event {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Event::ttCurrent()
	 * @used-by \Df\StripeClone\W\Event::id()
	 * @used-by \Df\StripeClone\W\Strategy\ConfirmPending::action()
	 * @return string
	 */
	function ttCurrent() {return self::T_CAPTURE;}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Event::ttParent()
	 * @used-by \Df\StripeClone\W\Nav::pidAdapt()
	 * @return string
	 */
	function ttParent() {return self::T_AUTHORIZE;}
}

