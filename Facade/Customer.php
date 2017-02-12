<?php
namespace Dfe\Paymill\Facade;
use Dfe\Paymill\Charge as _Charge;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Response\Client as C;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Request as API;
use Paymill\Services\PaymillException as lException;
// 2017-02-10
/** @method \Dfe\Paymill\Method m() */
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @param C $c
	 * @param string $token
	 * @return string
	 */
	function cardAdd($c, $token) {
		/** @var oCard $oCard */
		$oCard = $this->api()->create((new iCard)->setClient($c->getId())->setToken($token));
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
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @param array(string => mixed) $p
	 * @return C
	 */
	function create(array $p) {
		/** @var API $api */
		$api = $this->api();
		/** @var C $result */
		$result = $api->create((new iCustomer)
			->setEmail($p[_Charge::KC_EMAIL])->setDescription($p[_Charge::KC_DESCRIPTION])
		);
		$api->create((new iCard)->setClient($result->getId())->setToken($p[_Charge::K_CARD]));
		return $result;
	}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::get()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @param int $id
	 * @return C|null
	 */
	function get($id) {
		try {return $this->api()->getOne((new iCustomer)->setId($id));}
		catch (lException $e) {return null;}
	}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @param C $c
	 * @return string
	 */
	function id($c) {return $c->getId();}

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
	 * @return API
	 */
	private function api() {return $this->m()->api();}
}