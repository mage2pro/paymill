<?php
namespace Dfe\Paymill\P;
use Df\Core\Exception as DFE;
use Magento\Sales\Model\Order\Payment as OP;
# 2017-02-09
# 2017-09-05 The Paymill API reference: https://developers.paymill.com/API/index
final class Charge extends \Df\StripeClone\P\Charge {
	/**
	 * 2017-02-11
	 * 2017-10-09 The key name of a bank card token or of a saved bank card ID.
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