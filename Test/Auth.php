<?php
namespace Dfe\Paymill\Test;
use Paymill\Models\Request\Preauthorization as iAuth;
use Paymill\Models\Response\Preauthorization as oAuth;
# 2017-02-12
final class Auth extends CaseT {
	/**
	 * 2017-02-12
	 * [Paymill] An example of a preauthorization response: https://mage2.pro/t/2731
	 */
	function t01() {
		/** @var iAuth $iAuth */
		$iAuth = new iAuth;
		$iAuth->setToken($this->token());
		$iAuth->setAmount(100);
		$iAuth->setCurrency('EUR');
		/** @var oAuth $oAuth */
		$oAuth = $this->api()->create($iAuth);
		$this->showLastResponse();
	}

	/** 2017-02-12 @test */
	function t02() {
		/** @var iAuth $iAuth */
		$iAuth = new iAuth;
		$iAuth->setId('preauth_4dfe6453fd15d1628a99');
        $this->api()->delete($iAuth);
		$this->showLastResponse();
	}
}