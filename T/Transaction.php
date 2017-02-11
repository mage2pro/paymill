<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Transaction as lTransactionReq;
use Paymill\Models\Response\Transaction as lTransactionRes;
use Paymill\Request as lRequest;
final class Transaction extends TestCase {
	/** @test 2017-02-11 */
	public function t01() {
		/** @var lRequest $api */
		$api = $this->api();
		/** @var lTransactionReq $req */
		$req = new lTransactionReq;
		$req->setAmount(100);
		$req->setCurrency('EUR');
		$req->setToken($this->token());
		/** @var lTransactionRes $res */
		$res = $api->create($req);
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}
}