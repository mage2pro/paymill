<?php
namespace Dfe\Paymill;
// 2017-02-14
// «Which events does Paymill send to a store?» https://mage2.pro/t/2744
abstract class Webhook extends \Df\StripeClone\Webhook {
	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\Payment\Webhook::parentIdRawKey()
	 * @used-by \Df\Payment\Webhook::parentIdRaw()
	 * @return string
	 */
	protected function parentIdRawKey() {return '';}

	/**
	 * 2017-02-14
	 * @override
	 * @see \Df\StripeClone\Webhook::roPath()
	 * @used-by \Df\StripeClone\Webhook::ro()
	 * @return string
	 */
	final protected function roPath() {return '';}
}