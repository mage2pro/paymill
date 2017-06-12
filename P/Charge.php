<?php
namespace Dfe\Paymill\P;
use Df\Core\Exception as DFE;
use Magento\Sales\Model\Order\Payment as OP;
// 2017-02-09
final class Charge extends \Df\StripeClone\P\Charge {
	/**
	 * 2017-02-11
	 * 2017-02-18 Ключ, значением которого является токен банковской карты.
	 * @override
	 * @see \Df\StripeClone\P\Charge::k_CardId()
	 * @used-by \Df\StripeClone\P\Charge::request()
	 * @return string
	 */
	function k_CardId() {return self::K_CARD;}

	/**
	 * 2017-02-18
	 * Does Paymill support dynamic statement descriptors? https://mage2.pro/t/2823
	 * @override
	 * @see \Df\StripeClone\P\Charge::k_DSD()
	 * @used-by \Df\StripeClone\P\Charge::request()
	 * @return string
	 */
	protected function k_DSD() {return null;}
	
	/**
	 * 2017-02-11
	 * @used-by k_CardId()
	 * @used-by \Dfe\Paymill\Facade\Charge::create()
	 * @used-by \Dfe\Paymill\Facade\Customer::create()
	 */
	const K_CARD = 'card';
}