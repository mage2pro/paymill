<?php
namespace Dfe\Paymill\Facade;
use Paymill\Models\Response\Payment as C;
// 2017-02-11
// https://developers.paymill.com/API/index#-payment-object-for-credit-card-payments
final class Card implements \Df\StripeClone\Facade\ICard {
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
	 * 2017-02-11
	 * https://developers.paymill.com/API/index#list-payments-
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::brand()
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
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::country()
	 * @used-by \Df\StripeClone\CardFormatter::country()
	 * @return string
	 */
	function country() {return $this->_c->getCountry();}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return string|int
	 */
	function expMonth() {return $this->_c->getExpireMonth();}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return string
	 */
	function expYear() {return $this->_c->getExpireYear();}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return string
	 */
	function id() {return $this->_c->getId();}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::owner()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return string
	 */
	function owner() {return $this->_c->getCardHolder();}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::last4()
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