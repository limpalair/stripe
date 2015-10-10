<?php
/**
 * Stripe Portal Testing.
 *
 * @author Christophe Limpalair <christf24@gmail.com>
 */

use Limpalair\Stripe\StripePortal;

class StripePortalTest extends \Orchestra\Testbench\TestCase
{
	protected function getEnvrionmentSetUp($app)
	{
		$app['config']->set('services.stripe.secret', 'sk_test_Qz0DuTbrosLiuFvvDMN2q1iY');
	}

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
		$this->setExpectedException('\InvalidArgumentException', 'Missing credit card information');

		$stripePortal = new StripePortal();
		$stripePortal->chargeStripeCustomer('1000', ['id' => 'cu_a340958gfkdj']);
	}
}