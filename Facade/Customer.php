<?php
namespace Dfe\Paymill\Facade;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Response\Client as C;
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
	public function cardAdd($c, $token) {return '';}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cards()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @param C $c
	 * @return array(string => string)
	 */
	public function cards($c) {return [];}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @param array(string => mixed) $p
	 * @return C
	 */
	public function create(array $p) {return null;}

	/**
	 * 2017-02-10
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::get()
	 * @used-by \Df\StripeClone\Charge::newCard()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @param int $id
	 * @return C|null
	 */
	public function get($id) {
		try {return $this->m()->api()->getOne((new iCustomer)->setId($id));}
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
	public function id($c) {return $c->getId();}
}