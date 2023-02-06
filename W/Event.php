<?php
namespace Dfe\Paymill\W;
/**
 * 2017-03-15
 * @see \Dfe\Paymill\W\Event\Refund
 * @see \Dfe\Paymill\W\Event\Transaction\Succeeded
 */
abstract class Event extends \Df\StripeClone\W\Event {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\W\Event::roPath()
	 * @used-by \Df\StripeClone\W\Event::k_pid()
	 * @used-by \Df\StripeClone\W\Event::ro()
	 */
	final protected function roPath():string {return 'event/event_resource';}
}