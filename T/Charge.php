<?php
// 2017-02-08
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Payment as lPaymentReq;
use Paymill\Models\Response\Base as lResponseBase;
use Paymill\Models\Response\Payment as lPaymentResp;
use Paymill\Request as lRequest;
final class Charge extends TestCase {
	/**
	 * @test
	 * 2017-02-08
	 */
	public function t01() {
		/** @var lRequest $req */
		$req = $this->r();
		/** @var lResponseBase|lPaymentResp $resp */
		$resp = $req->create((new lPaymentReq)->setToken($this->token()));
		echo "Response ID: {$resp->getId()}\n";
		echo "Response data:\n" . df_json_encode_pretty($req->getLastResponse());
	}
}