<?php
namespace Dfe\Paymill\W;
/**
 * 2017-02-14
 * «Which events does Paymill send to a store?» https://mage2.pro/t/2744
 * @see \Dfe\Paymill\W\Handler\Refund\Succeeded
 * @see \Dfe\Paymill\W\Handler\Transaction\Succeeded
 */
abstract class Handler extends \Df\StripeClone\W\Handler {}