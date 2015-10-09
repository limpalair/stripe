<?php
/**
 * Stripe Portal Testing.
 *
 * @author Christophe Limpalair <christf24@gmail.com>
 */

use Limpalair\Stripe\StripePortal;

class StripePortalTest extends PHPUnit_Framework_TestCase
{
	public function testInstantiation()
	{
		$stripePortal = new StripePortal();
	}

	public function testExpectedGetStripeKey()
	{
		$stripePortal = new StripePortal();
		$this->expectedOutputString($stripePortal->getStripeKey());
	}

	public function testExpectedGetCurrency()
	{
		$stripePortal = new StripePortal();
		$this->expectedOutputString($stripePortal->getCurrency());
	}

	public function testExceptionChargeStripeCustomerNoCard()
	{
		$this->setExpectedExcetion('InvalidArgumentException', 'Missing credit card information');

		$stripePortal = new StripePortal();
		$stripePortal->chargeStripeCustomer('1000', ['id' => 'cu_a340958gfkdj']);
	}
}