<?php
namespace Dfe\Paymill;
use Dfe\Paymill\Source\Prefill;
// 2017-02-05
final class ConfigProvider extends \Df\StripeClone\ConfigProvider {
	/**
	 * 2017-02-05
	 * @override
	 * @see \Df\StripeClone\ConfigProvider::config()
	 * @used-by \Df\Payment\ConfigProvider::getConfig()
	 * @return array(string => mixed)
	 */
	protected function config() {return ['errorCardNumber' => Prefill::ERROR] + parent::config();}
}