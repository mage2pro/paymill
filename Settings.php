<?php
# 2017-02-05
namespace Dfe\Paymill;
/** @method static Settings s() */
final class Settings extends \Df\StripeClone\Settings {
	/**
	 * 2017-02-07
	 * @override
	 * @see \Df\Payment\Settings\BankCard::prefill()
	 * @used-by \Df\Payment\ConfigProvider\BankCard::config()
	 * @return string|null
	 */
	function prefill() {return $this->v("prefill{$this->test3DS('With', 'Without')}3DS");}

	/**
	 * 2017-02-07
	 * «Test with the 3D Secure validation?»
	 * Первый аргумент — для «да», второй — для «нет».
	 * @param mixed ...$a [optional]
	 * @used-by self::prefill()
	 * @return bool
	 */
	private function test3DS(...$a) {return df_b($a, $this->b());}
}