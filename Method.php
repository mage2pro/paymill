<?php
namespace Dfe\Paymill;
// 2017-02-05
class Method extends \Df\StripeClone\Method {
	/**
	 * 2017-02-05
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Method::apiCardInfo()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param object $charge
	 * @return array(string => string)
	 */
	final protected function apiCardInfo($charge) {return [];}
}