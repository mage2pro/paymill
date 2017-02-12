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
	 * @return mixed
	 */
	protected function cardIdPrefix() {return 'pay';}

	/**
	 * 2017-02-11
	 * Этот ключ передаётся как параметр при создании 2 разных объектов: charge и customer.
	 * @override
	 * @see \Df\StripeClone\Charge::keyCardId()
	 * @used-by \Df\StripeClone\Charge::request()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @return mixed
	 */
	protected function keyCardId() {return self::K_CARD;}
	
	/**
	 * 2017-02-11
	 * @used-by keyCardId()
	 * @used-by \Dfe\Paymill\Facade\Customer::create()
	 */
	const K_CARD = 'card';
}