<?php
// 2017-02-05
namespace Dfe\Paymill;
use Magento\Sales\Model\Order\Payment\Transaction as T;
use Paymill\Models\Request\Payment as lPayment;
use Paymill\Models\Response\Base as lResponseBase;
use Paymill\Models\Response\Payment as lResponsePayment;
use Paymill\Request as lRequest;
/** @method Settings s() */
final class Method extends \Df\StripeClone\Method {
	/**
	 * 2017-02-05
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Method::apiCardInfo()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param object $charge
	 * @return array(string => string)
	 */
	protected function apiCardInfo($charge) {return [];}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::apiChargeCapturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param string $chargeId
	 * @return object
	 */
	protected function apiChargeCapturePreauthorized($chargeId) {return null;}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::apiChargeCreate()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $params
	 * @return object
	 */
	protected function apiChargeCreate(array $params) {return null;}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::apiChargeId()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param \Stripe\Charge $charge
	 * @return string
	 */
	protected function apiChargeId($charge) {return '';}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::apiTransId()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param object $response
	 * @return string
	 */
	protected function apiTransId($response) {return '';}

	/**
	 * 2017-02-05
	 * 2017-02-08
	 * [Paymill][PHP SDK] How to get the last API response as an array? https://mage2.pro/t/2682
	 * @override
	 * @see \Df\StripeClone\Method::responseToArray()
	 * @used-by \Df\StripeClone\Method::transInfo()
	 * @param object $response
	 * @return array(string => mixed)
	 */
	protected function responseToArray($response) {return dfa_deep(
		$this->req()->getLastResponse(), 'body/data'
	);}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::scRefund()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $chargeId
	 * @param float|null $amount
	 * В формате и валюте платёжной системы.
	 * Значение готово для применения в запросе API.
	 * @return object
	 */
	protected function scRefund($chargeId, $amount) {return null;}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::scVoid()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $chargeId
	 * @return object
	 */
	protected function scVoid($chargeId) {return null;}

	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\Method::transUrlBase()
	 * @used-by \Df\StripeClone\Method::transUrl()
	 * @param T $t
	 * @return string
	 */
	protected function transUrlBase(T $t) {return '';}

	/**
	 * 2017-02-08
	 * Класс @see \Paymill\Models\Response\Payment не предоставляет нам доступа
	 * ко всему ответу целиком, в виде массива:
	 * https://github.com/paymill/paymill-php/blob/v4.4.1/lib/Paymill/Models/Response/Payment.php#L13
	 *
	 * Поэтому, чтобы получить ответ в виде массива, мы используем метод
	 * @see \Paymill\Request::getLastResponse()
	 * https://github.com/paymill/paymill-php/blob/v4.4.1/lib/Paymill/Request.php#L139-L146
	 * А для этого нам нужно хранить объект - менеджеров запросов.
	 * [Paymill][PHP SDK] How to get the last API response as an array? https://mage2.pro/t/2682
	 *
	 * Причём @see \Paymill\Request — это именно менеджер запросов, а не сам запрос.
	 * Сам запрос имеет класс какого-либо из потомков @see \Paymill\Models\Response\Base:
	 * например: @see \Paymill\Models\Response\Payment
	 * Связь между ними показана в моём модульном тесте:
	 * https://github.com/mage2pro/paymill/blob/0.1.8/T/Charge.php?ts=4#L14-L17
	 * @return lRequest
	 */
	private function req() {return dfc($this, function() {return
		new lRequest($this->s()->privateKey())
	;});}
}