<?php
// 2017-02-14
namespace Dfe\Paymill;
final class WebhookF extends \Df\StripeClone\WebhookF {
	/**             
	 * 2017-02-14
	 * [Paymill] An example of the «transaction.created» event (being sent to a webhook)
	 * https://mage2.pro/t/2743
	 * @override
	 * @see \Df\StripeClone\WebhookF::typeKey()
	 * @used-by \Df\StripeClone\WebhookF::type()
	 * @return string
	 */
	protected function typeKey() {return 'event/event_type';}
}


