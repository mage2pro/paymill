<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Payment as lPayment;
use Paymill\Models\Response\Base as lResponseBase;
use Paymill\Models\Response\Payment as lResponsePayment;
final class Charge extends TestCase {
	/**
	 * @test
	 * 2017-02-08
	 */
	public function t01() {
		/** @var lResponseBase|lResponsePayment $resp */
		$resp = $this->r()->create((new lPayment)->setToken($this->token()));
		echo $resp->getId();
	}
}