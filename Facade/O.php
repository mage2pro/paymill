<?php
namespace Dfe\Paymill\Facade;
// 2017-02-11
/** @method \Dfe\Paymill\Method m() */
final class O extends \Df\StripeClone\Facade\O {
	/**
	 * 2017-02-11
	 * An example of Paymill response: https://mage2.pro/t/2682
	 * @see \Dfe\Paymill\Facade\Charge::pathToCard()
	 * @override
	 * @see \Df\StripeClone\Facade\O::toArray()
	 * @used-by \Df\StripeClone\Method::transInfo()
	 * @param object $o
	 * @return array(string => mixed)
	 */
	function toArray($o) {return dfa_deep($this->m()->api()->getLastResponse(), 'body/data');}
}