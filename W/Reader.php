<?php
namespace Dfe\Paymill\W;
# 2017-03-10
final class Reader extends \Df\Payment\W\Reader\Json {
	/**             
	 * 2017-02-14
	 * [Paymill] An example of the «transaction.created» event (being sent to a webhook)
	 * https://mage2.pro/t/2743
	 * @override
	 * @see \Df\Payment\W\Reader::kt()
	 * @used-by \Df\Payment\W\Reader::tRaw()
	 */
	protected function kt():string {return 'event/event_type';}
}