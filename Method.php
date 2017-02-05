<?php
namespace Dfe\Paymill;
// 2017-02-05
class Method extends \Df\StripeClone\Method {
	/**
	 * 2017-02-05
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Method::apiCardInfo()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param object $charge
	 * @return array(string => string)
	 */
	final protected function apiCardInfo($charge) {return [];}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::apiChargeCapturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param string $chargeId
	 * @return object
	 */
	final protected function apiChargeCapturePreauthorized($chargeId) {return null;}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::apiChargeCreate()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $params
	 * @return object
	 */
	final protected function apiChargeCreate(array $params) {return null;}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::responseToArray()
	 * @used-by \Df\StripeClone\Method::transInfo()
	 * @param object $response
	 * @return array(string => mixed)
	 */
	final protected function responseToArray($response) {return [];}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::scVoid()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $chargeId
	 * @return object
	 */
	final protected function scVoid($chargeId) {return null;}
}