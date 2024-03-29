<?php
namespace Dfe\Paymill\Facade;
use Df\StripeClone\P\Reg;
use Dfe\Paymill\P\Charge as _Charge;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Client as C;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
# 2017-02-10
/** @method \Dfe\Paymill\Method m() */
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2017-02-10
	 * 2022-12-19 We can not declare the $c argument type because it is undeclared in the overriden method.
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @used-by self::create()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param C $c
	 */
	function cardAdd($c, string $token):string {
		$oCard = $this->api()->create((new iCard)->setClient($c->getId())->setToken($token)); /** @var oCard $oCard */
		$c->setPayment(array_merge($c->getPayment(), [$oCard]));
		return $oCard->getId();
	}

	/**
	 * 2017-02-10
	 * Этот метод должен регистрировать в ПС не только покупателя, но и его банковскую карту.
	 * Stripe и Omise умеют делать это сразу (в ответ на единый запрос к ПС),
	 * а вот для Paymill банковскую карту надо регистрировать отдельным запросом к ПС.
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param array(string => mixed) $p
	 */
	function create(array $p):C {
		/** @var C $r */
		$r = $this->api()->create((new iCustomer)->setEmail($p[Reg::K_EMAIL])->setDescription($p[Reg::K_DESCRIPTION]));
		$this->cardAdd($r, $p[_Charge::K_CARD]);
		return $r;
	}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param C $c
	 */
	function id($c):string {return $c->getId();}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::_get()
	 * @used-by \Df\StripeClone\Facade\Customer::get()
	 * @param string $id
	 * @return C|null
	 */
	protected function _get($id) {return $this->api()->getOne((new iCustomer)->setId($id));}

	/**
	 * 2017-02-11
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardsData()
	 * @used-by \Df\StripeClone\Facade\Customer::cards()
	 * @param C $c
	 * @return oCard[]
	 * @see \Dfe\Paymill\Facade\Charge::cardData()
	 */
	protected function cardsData($c) {return $c->getPayment();}

	/**
	 * 2017-02-11
	 * @used-by self::capturePreauthorized()
	 * @used-by self::create()
	 * @used-by self::load()
	 * @used-by self::refund()
	 * @used-by self::void()
	 */
	private function api():API {return $this->m()->api();}
}