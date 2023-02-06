<?php
namespace Dfe\Paymill\Facade;
# 2017-02-11
/** @method \Dfe\Paymill\Method m() */
final class O extends \Df\StripeClone\Facade\O {
	/**
	 * 2017-02-11 A Paymill response: https://mage2.pro/t/2682
	 * 2022-11-17
	 * `object` as an argument type is not supported by PHP < 7.2:
	 * https://github.com/mage2pro/core/issues/174#user-content-object
	 * @see \Dfe\Paymill\Facade\Charge::pathToCard()
	 * @override
	 * @see \Df\StripeClone\Facade\O::toArray()
	 * @used-by \Df\StripeClone\Method::transInfo()
	 * @param object $o
	 * @return array(string => mixed)
	 */
	function toArray($o):array {return dfa_deep($this->m()->api()->getLastResponse(), 'body/data');}
}