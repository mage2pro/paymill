<?php
// 2017-02-12
namespace Dfe\Paymill\T;
use Paymill\Models\Request\Client as iCustomer;
use Paymill\Models\Request\Payment as iCard;
use Paymill\Models\Request\Preauthorization as iAuth;
use Paymill\Models\Request\Transaction as iCharge;
use Paymill\Models\Response\Client as oCustomer;
use Paymill\Models\Response\Payment as oCard;
use Paymill\Models\Response\Preauthorization as oAuth;
use Paymill\Models\Response\Transaction as oCharge;
use Paymill\Request as lRequest;
final class Auth extends TestCase {
	/** @test */
	function t00() {
		/** @var iAuth $iAuth */
		$iAuth = new iAuth;
		$iAuth->setToken($this->token());
		$iAuth->setAmount(100);
		$iAuth->setCurrency('EUR');
		/** @var oAuth $oAuth */
		$oAuth = $this->api()->create($iAuth);
		$this->showLastResponse();
		/**
			{
				"header": {
					"status": 200,
					"reason": null
				},
				"body": {
					"data": {
						"id": "preauth_4dfe6453fd15d1628a99",
						"amount": "100",
						"currency": "EUR",
						"description": null,
						"status": "closed",
						"livemode": false,
						"created_at": 1486880115,
						"updated_at": 1486880117,
						"app_id": null,
						"payment": {
							"id": "pay_66d0667edfacce5be9a1e26a",
							"type": "creditcard",
							"client": "client_11bfba8c849669fc2ee8",
							"card_type": "visa",
							"country": "DE",
							"expire_month": "12",
							"expire_year": "2018",
							"card_holder": "DMITRY FEDYUK",
							"last4": "1111",
							"updated_at": 1486880115,
							"created_at": 1486880115,
							"app_id": null,
							"is_recurring": true,
							"is_usable_for_preauthorization": true
						},
						"client": {
							"id": "client_11bfba8c849669fc2ee8",
							"email": null,
							"description": null,
							"app_id": null,
							"updated_at": 1486880115,
							"created_at": 1486880115,
							"payment": [
								"pay_66d0667edfacce5be9a1e26a"
							],
							"subscription": null
						},
						"transaction": {
							"id": "tran_fd668e1d78869059ec34799d4bb3",
							"amount": 100,
							"origin_amount": 100,
							"status": "preauth",
							"description": null,
							"livemode": false,
							"refunds": null,
							"client": "client_11bfba8c849669fc2ee8",
							"currency": "EUR",
							"created_at": 1486880115,
							"updated_at": 1486880117,
							"response_code": 20000,
							"short_id": null,
							"is_fraud": false,
							"invoices": [],
							"app_id": null,
							"preauthorization": "preauth_4dfe6453fd15d1628a99",
							"fees": [],
							"payment": "pay_66d0667edfacce5be9a1e26a",
							"mandate_reference": null,
							"is_refundable": false,
							"is_markable_as_fraud": true
						}
					},
					"mode": "test"
				}
			}
		 */
	}
}