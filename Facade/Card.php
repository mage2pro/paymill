<?php
namespace Dfe\Paymill\Facade;
use Paymill\Models\Response\Payment as C;
// 2017-02-11
final class Card implements \Df\StripeClone\Facade\ICard {
	/**
	 * 2017-02-11
	 * @param C|array(string => string) $c
	 */
	public function __construct($c) {$this->_c = is_object($c) ? $c : (new C)
		->setCardType($c['card_type'])
		->setCountry($c['country'])
		->setExpireMonth($c['expire_month'])
		->setExpireYear($c['expire_year'])
		->setLastFour($c['last4'])
		->setId($c['id'])
	;}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\ICard::brand()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 * @return string
	 */
	public function brand() {return $this->_c->getCardType();}

	/**
	 * 2017-02-11
	 * @see \Df\StripeClone\Facade\ICard::country()
	 * @used-by \Df\StripeClone\CardFormatter::country()
	 * @return string
	 */
	public function country() {return $this->_c->getCountry();}

	/**
	 * 2017-02-11
	 * @see \Df\StripeClone\Facade\ICard::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @return string
	 */
	public function expMonth() {return $this->_c->getExpireMonth();}

	/**
	 * 2017-02-11
	 * @see \Df\StripeClone\Facade\ICard::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @return string
	 */
	public function expYear() {return $this->_c->getExpireYear();}

	/**
	 * 2017-02-11
	 * @see \Df\StripeClone\Facade\ICard::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return string
	 */
	public function id() {return $this->_c->getId();}

	/**
	 * 2017-02-11
	 * @see \Df\StripeClone\Facade\ICard::last4()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 * @return string
	 */
	public function last4() {return $this->_c->getLastFour();}

	/**
	 * 2017-02-11
	 * @var C
	 */
	private $_c;
}