<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Payment as lPayment;
use Paymill\Models\Response\Base as lResponseBase;
use Paymill\Models\Response\Payment as lResponsePayment;
use Paymill\Request as lRequest;
final class Charge extends TestCase {
	/**
	 * @test
	 * 2017-02-08
	 */
	public function t01() {
		/** @var lRequest $req */
		$req = $this->r();
		/** @var lResponseBase|lResponsePayment $resp */
		$resp = $req->create((new lPayment)->setToken($this->token()));
		echo df_json_encode_pretty([
			'Response ID' => $resp->getId()
			,'Response' => $req->getLastResponse()
		]);
	}
}