<?php
namespace Dfe\Paymill;
use Df\Core\Exception as DFE;
use Magento\Sales\Model\Order\Payment as OP;
// 2017-02-09
final class Charge extends \Df\StripeClone\Charge {
	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Charge::_request()
	 * @used-by \Df\StripeClone\Charge::request()
	 * @return array(string => mixed)
	 */
	protected function _request() {/** @var Settings $s */ $s = $this->ss(); return [];}

	/**
	 * 2017-02-11
	 * Идентификаторы банковских карт (в терминологии Paymill - «Payment») имеют вид
	 * «pay_ddcc9210289ede708c97eb67».
	 * @override
	 * @see \Df\StripeClone\Charge::cardIdPrefix()
	 * @used-by \Df\StripeClone\Charge::usePreviousCard()
	 * @return mixed
	 */
	protected function cardIdPrefix() {return 'pay';}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Charge::customerParams()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @return array(string => mixed)
	 */
	protected function customerParams() {return [
		self::C_DESCRIPTION => $this->customerName(), self::C_EMAIL => $this->customerEmail()
	];}

	/**
	 * 2017-02-11
	 * @used-by customerParams()
	 * @used-by \Dfe\Paymill\Facade\Customer::create()
	 */
	const C_DESCRIPTION = 'description';
	/**
	 * 2017-02-11
	 * @used-by customerParams()
	 * @used-by \Dfe\Paymill\Facade\Customer::create()
	 */
	const C_EMAIL = 'email';
}