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
	 * 2017-02-18
	 * Ключ, значением которого является токен банковской карты.
	 * Этот ключ передаётся как параметр ДВУХ РАЗНЫХ запросов к API ПС:
	 * 1) в запросе на проведение транзакции (charge)
	 * 2) в запросе на сохранение банковской карты для будущего повторного использования
	 * У Paymill название этого параметра для обоих запросов совпадает.
	 * @override
	 * @see \Df\StripeClone\Charge::k_CardId()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @used-by \Df\StripeClone\Charge::request()
	 * @return string
	 */
	protected function k_CardId() {return self::K_CARD;}

	/**
	 * 2017-02-18
	 * Does Paymill support dynamic statement descriptors? https://mage2.pro/t/2823
	 * @override
	 * @see \Df\StripeClone\Charge::k_DSD()
	 * @used-by \Df\StripeClone\Charge::request()
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