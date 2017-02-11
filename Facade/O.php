<?php
namespace Dfe\Paymill\Facade;
use Dfe\Paymill\Method as M;
// 2017-02-11
/** @method M m() */
final class O extends \Df\StripeClone\Facade\O {
	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\O::toArray()
	 * @used-by \Df\StripeClone\Method::transInfo()
	 * @param object $o
	 * @return array(string => mixed)
	 */
	public function toArray($o) {return dfa_deep($this->m()->api()->getLastResponse(), 'body/data');}
}