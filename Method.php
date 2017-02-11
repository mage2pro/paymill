<?php
// 2017-02-05
namespace Dfe\Paymill;
use Df\Sales\Model\Order\Payment as DfOP;
use Magento\Sales\Model\Order\Payment as OP;
use Magento\Sales\Model\Order\Payment\Transaction as T;
use Paymill\Request as API;
/** @method Settings s() */
final class Method extends \Df\StripeClone\Method {
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
	 *
	 * @used-by \Dfe\Paymill\Facade\O::toArray()
	 * @return API
	 */
	final function api() {return dfc($this, function() {return
		new API($this->s()->privateKey())
	;});}

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
	 * @override
	 * @see \Df\StripeClone\Method::transUrlBase()
	 * @used-by \Df\StripeClone\Method::transUrl()
	 * @param T $t
	 * @return string
	 */
	protected function transUrlBase(T $t) {return '';}
}