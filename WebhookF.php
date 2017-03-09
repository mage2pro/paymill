<?php
// 2017-02-14
namespace Dfe\Paymill;
final class WebhookF extends \Df\Payment\WebhookF\Json {
	/**             
	 * 2017-02-14
	 * [Paymill] An example of the «transaction.created» event (being sent to a webhook)
	 * https://mage2.pro/t/2743
	 * @override
	 * @see \Df\Payment\WebhookF\Json::typeKey()
	 * @used-by \Df\Payment\WebhookF\Json::type()
	 * @return string
	 */
	protected function typeKey() {return 'event/event_type';}
}


