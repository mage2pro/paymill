<?php
namespace Dfe\Paymill;
// 2017-02-12
final class ResponseRecord extends \Df\StripeClone\ResponseRecord {
	/**
	 * 2017-02-12
	 * Returns the path to the bank card information in the payment system response.
	 * https://developers.paymill.com/API/index#create-new-transaction-
	 * An example of Paymill response: https://mage2.pro/t/2682
	 * @see \Dfe\Paymill\Facade\O::toArray()
	 * @override
	 * @see \Df\StripeClone\ResponseRecord::keyCard()
	 * @used-by \Df\StripeClone\ResponseRecord::card()
	 * @return string
	 */
	protected function keyCard() {return 'payment';}
}