<?php
// 2017-02-05
namespace Dfe\Paymill;
use Df\Sales\Model\Order\Payment as DfOP;
use Magento\Sales\Model\Order\Payment as OP;
use Magento\Sales\Model\Order\Payment\Transaction as T;
use Paymill\Models\Request\Payment as lPaymentReq;
use Paymill\Models\Response\Base as lResponseBase;
use Paymill\Models\Response\Payment as lPaymentResp;
use Paymill\Request as lRequest;
/** @method Settings s() */
final class Method extends \Df\StripeClone\Method {
	/**
	 * 2017-02-08
	 * @override
	 * The result should be in the basic monetary unit (like dollars), not in fractions (like cents).
	 * I did not find such information on the Paymill website.
	 * «Does Paymill have minimum and maximum amount limitations on a single payment?»
	 * https://mage2.pro/t/2690
	 * https://paymill.zendesk.com/hc/en-us/requests/129737
	 *
	 * 2017-02-10
	 * I have got an answer from the Paymill support:
	 * «Depending on the acquirer yes.
	 * But this can be negotiated according your business model and risk possibilities.»
	 * https://mage2.pro/t/2690/3
	 *
	 * @see \Df\Payment\Method::amountLimits()
	 * @used-by \Df\Payment\Method::isAvailable()
	 * @return null
	 */
	protected function amountLimits() {return null;}

	/**
	 * 2017-02-05
	 * Информация о банковской карте.
	 * @override
	 * @see \Df\StripeClone\Method::apiCardInfo()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param lPaymentResp $charge
	 * @return array(string => string)
	 */
	protected function apiCardInfo($charge) {return [
		// 2017-02-09
		// 2-символьный код: «DE»
		DfOP::COUNTRY => $charge->getCountry()
		,OP::CC_EXP_MONTH => $charge->getExpireMonth()
		,OP::CC_EXP_YEAR => $charge->getExpireYear()
		,OP::CC_LAST_4 => $charge->getLastFour()
		,OP::CC_OWNER => $charge->getCardHolder()
		// 2017-02-09
		// https://developers.paymill.com/API/index#list-payments-
		,OP::CC_TYPE => dftr($charge->getCardType(), [
			'amex' => 'American Express'
			,'diners' => 'Diners Club'
			,'discover' => 'Discover'
			,'jcb' => 'JCB'
			,'maestro' => 'Maestro'
			,'mastercard' => 'MasterCard'
			,'unknown' => 'Unknown'
			,'visa' => 'Visa'
		])
	];}

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
	 * @param lPaymentResp $charge
	 * @return string
	 */
	protected function apiChargeId($charge) {return $charge->getId();}

	/**
	 * 2017-02-05
	 * Пока этот метод используется только в сценарии возврата.
	 * Метод должен вернуть идентификатор операции (не платежа!) в платёжной системе.
	 * Мы записываем его в БД и затем при обработке оповещений от платёжной системы
	 * смотрим, не было ли это оповещение инициировано нашей же операцией,
	 * и если было, то не обрабатываем его повторно.
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