<?php
namespace Dfe\Paymill\Source\Prefill;
final class With3DS extends \Df\Config\SourceT {
	/**
	 * 2017-02-05
	 * https://mage2.pro/t/2639
	 * @override
	 * @see \Df\Config\Source::map()
	 * @used-by \Df\Config\Source::toOptionArray()
	 * @return array(string => string)
	 */
	protected function map() {return $this->addKeysToValues([
		'4012888888881881' => 'Visa'
		,'5169147129584558' => 'MasterCard'
	]);}
}