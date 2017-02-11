<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as lClientReq;
use Paymill\Models\Response\Client as lClientResp;
use Paymill\Request as lRequest;
final class Client extends TestCase {
	/**
	 * @test
	 * 2017-02-08
	 */
	public function t01() {
		/** @var lRequest $api */
		$api = $this->api();
		/** @var lClientReq $req */
		$req = new lClientReq;
		$req->setEmail('admin@mage2.pro');
		$req->setDescription('Дмитрий Федюк');
		/** @var lClientResp $resp */
		$resp = $api->create($req);
		echo "Response ID: {$resp->getId()}\n";
		echo "Response data:\n" . df_json_encode_pretty($api->getLastResponse());
	}
}