<?php
namespace Dfe\Paymill;
/**
 * 2017-02-14
 * «Which events does Paymill send to a store?» https://mage2.pro/t/2744
 * @see \Dfe\Paymill\Webhook\Transaction\Succeeded
 */
abstract class Webhook extends \Df\StripeClone\Webhook {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\Webhook::roPath()
	 * @used-by \Df\StripeClone\Webhook::ro()
	 * @return string
	 */
	final protected function roPath() {return 'event/event_resource';}
}