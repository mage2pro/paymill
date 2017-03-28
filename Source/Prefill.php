<?php
namespace Dfe\Paymill\Source;
/**
 * 2017-02-07
 * @see \Dfe\Paymill\Source\Prefill\With3DS
 * @see \Dfe\Paymill\Source\Prefill\Without3DS
 */
abstract class Prefill extends \Df\Config\Source {
	/**
	 * 2017-02-07
	 * https://developers.paymill.com/guides/reference/testing#how-do-i-test-credit-card-specific-error-codes-
	 * @used-by \Dfe\Paymill\ConfigProvider::config()
	 * @used-by \Dfe\Paymill\Source\Prefill\With3DS::map()
	 * @used-by \Dfe\Paymill\Source\Prefill\Without3DS::map()
	 */
	const ERROR = '5105105105105100';
}