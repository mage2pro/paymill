<?php
// 2017-02-11
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as lClientReq;
use Paymill\Models\Response\Client as lClientResp;
use Paymill\Request as lRequest;
final class Client extends TestCase {
	/** 2017-02-11 */
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

	/** @test 2017-02-11 */
	public function t02() {array_map(function($id) {
		$this->api()->delete((new lClientReq)->setId($id));
	}, $this->ids());}

	/**
	 * 2017-02-11
	 * Возвращает не все записи, а только часть.
	 * https://developers.paymill.com/API/index#list-clients-
	 * @return string[]
	 */
	private function ids() {return array_column($this->api()->getAll(new lClientReq), 'id');}
}