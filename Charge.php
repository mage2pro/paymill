<?php
namespace Dfe\Paymill;
use Df\Core\Exception as DFE;
use Magento\Sales\Model\Order\Payment as OP;
// 2017-02-09
final class Charge extends \Df\StripeClone\Charge {
	/**
	 * 2017-02-11
	 * Идентификаторы банковских карт (в терминологии Paymill - «Payment») имеют вид
	 * «pay_ddcc9210289ede708c97eb67».
	 * @override
	 * @see \Df\StripeClone\Charge::cardIdPrefix()
	 * @used-by \Df\StripeClone\Charge::usePreviousCard()
	 * @return string
	 */
	protected function cardIdPrefix() {return 'pay';}

	/**
	 * 2017-02-11
	 * Этот ключ передаётся как параметр при создании 2 разных объектов: charge и customer.
	 * @override
	 * @see \Df\StripeClone\Charge::keyCardId()
	 * @used-by \Df\StripeClone\Charge::request()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @return string
	 */
	protected function keyCardId() {return self::K_CARD;}

	/**
	 * 2017-02-18
	 * Does Paymill support dynamic statement descriptors? https://mage2.pro/t/2823
	 * @override
	 * @see \Df\StripeClone\Charge::keyDSD()
	 * @used-by \Df\StripeClone\Charge::request()
	 * @return string
	 */
	protected function keyDSD() {return null;}
	
	/**
	 * 2017-02-11
	 * @used-by keyCardId()
	 * @used-by \Dfe\Paymill\Facade\Charge::create()
	 * @used-by \Dfe\Paymill\Facade\Customer::create()
	 */
	const K_CARD = 'card';
}