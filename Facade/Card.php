<?php
namespace Dfe\Paymill\Facade;
use Paymill\Models\Response\Payment as C;
// 2017-02-11 https://developers.paymill.com/API/index#-payment-object-for-credit-card-payments
final class Card extends \Df\StripeClone\Facade\Card {
	/**
	 * 2017-02-11
	 * @used-by \Df\StripeClone\Facade\Card::create()
	 * @param C|array(string => string) $c
	 */
	function __construct($c) {$this->_c = is_object($c) ? $c : (new C)
		->setCardHolder($c['card_holder'])
		->setCardType($c['card_type'])
		->setCountry($c['country'])
		->setExpireMonth($c['expire_month'])
		->setExpireYear($c['expire_year'])
		->setLastFour($c['last4'])
		->setId($c['id'])
	;}

	/**
	 * 2017-02-11 https://developers.paymill.com/API/index#list-payments-
	 * 2017-10-07 «Card type. eg. visa, mastercard ...»
	 * Type: string.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::brand()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 * @return string
	 */
	function brand() {return dftr($this->_c->getCardType(), [
		'amex' => 'American Express'
		,'diners' => 'Diners Club'
		,'discover' => 'Discover'
		,'jcb' => 'JCB'
		,'maestro' => 'Maestro'
		,'mastercard' => 'MasterCard'
		,'unknown' => 'Unknown'
		,'visa' => 'Visa'
	]);}

	/**
	 * 2017-02-11
	 * 2017-10-07
	 * Note 1. An ISO-2 code.
	 * Note 2. «Customer address country. E.g. DE.»
	 * Type: string / null.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::country()
	 * @used-by \Df\StripeClone\CardFormatter::country()
	 * @return string|null
	 */
	function country() {return $this->_c->getCountry();}

	/**
	 * 2017-02-11
	 * 2017-10-07 «Expiry month of the credit card»
	 * E.g.: «10».
	 * Type: string.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return int
	 */
	function expMonth() {return intval($this->_c->getExpireMonth());}

	/**
	 * 2017-02-11
	 * 2017-10-07 «xpiry year of the credit card»
	 * E.g.: «2013».
	 * Type: string.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return int
	 */
	function expYear() {return intval($this->_c->getExpireYear());}

	/**
	 * 2017-02-11
	 * 2017-10-07 «Unique identifier for this credit card payment»
	 * Type: string.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return string
	 */
	function id() {return $this->_c->getId();}

	/**
	 * 2017-02-11
	 * 2017-10-07 «Name of the card holder»
	 * Type: string.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::owner()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return string
	 */
	function owner() {return $this->_c->getCardHolder();}

	/**
	 * 2017-02-11
	 * 2017-10-07 «The last four digits of the credit card»
	 * Type: string.
	 * @override
	 * @see \Df\StripeClone\Facade\Card::last4()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 * @return string
	 */
	function last4() {return $this->_c->getLastFour();}

	/**
	 * 2017-02-11
	 * @var C
	 */
	private $_c;
}