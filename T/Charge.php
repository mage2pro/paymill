<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Dfe\Paymill\Settings as S;
final class Charge extends TestCase {
	/**
	 * @test
	 * 2017-02-08
	 * An example of response: «tok_1febe8863f91d32e2f8a4734278f».
	 */
	public function t01() {
		$request = new \Paymill\Request(S::s()->privateKey());
		$payment = new \Paymill\Models\Request\Payment();
		$payment->setToken($this->token());
		$response = $request->create($payment);
		echo $response->getId();
	}
}