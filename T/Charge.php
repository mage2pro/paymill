<?php
// 2017-02-08
namespace Dfe\Paymill\T;
final class Charge extends TestCase {
	/**
	 * @test
	 * 2017-02-08
	 * An example of response: «tok_1febe8863f91d32e2f8a4734278f».
	 */
	public function t01() {echo $this->token();}
}