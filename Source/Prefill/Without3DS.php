<?php
namespace Dfe\Paymill\Source\Prefill;
final class Without3DS extends \Dfe\Paymill\Source\Prefill {
	/**
	 * 2017-02-05
	 * https://mage2.pro/t/2639
	 * @override
	 * @see \Df\Config\Source::map()
	 * @used-by \Df\Config\Source::toOptionArray()
	 * @return array(string => string)
	 */
	protected function map() {return $this->addKeysToValues([
		'4111111111111111' => 'Visa'
		,'5500000000000004' => 'MasterCard'
		,'340000000000009' => 'American Express'
		,'3530111333300000' => 'JCB'
		,'6759000000000000' => 'Maestro UK'
		,'4973010000000004' => 'Carte Bleue'
		,'30000000000004' => 'Diners Club'
		,'6011111111111117' => 'Discover'
		,self::ERROR => 'Error'
	]);}
}