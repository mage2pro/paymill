<?php
namespace Dfe\Paymill;
use Df\Core\Exception as DFE;
use Magento\Sales\Model\Order\Payment as OP;
/**
 * 2017-02-09
 * @method Settings ss()
 */
abstract class Charge extends \Df\StripeClone\Charge {}