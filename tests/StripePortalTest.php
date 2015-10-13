<?php
/**
 * Stripe Portal Testing.
 *
 * @author Christophe Limpalair <christf24@gmail.com>
 */

use Limpalair\Stripe\StripePortal;

class StripePortalTest extends \Orchestra\Testbench\TestCase
{
	protected function getEnvironmentSetUp($app)
	{
		$app['config']->set('services.stripe.secret', getenv('STRIPE_SECRET'));
	}

	public function testInstantiation()
	{
		$stripePortal = new StripePortal();
	}

	public function testExpectedGetCurrency()
	{
		$stripePortal = new StripePortal();
		$this->expectOutputString($stripePortal->getCurrency());

		print 'usd';
	}

	public function testExceptionChargeStripeCustomerNoCard()
	{
		$this->setExpectedException('\InvalidArgumentException', 'Missing credit card information');

		$stripePortal = new StripePortal();
		$stripePortal->chargeStripeCustomer('1000', ['id' => 'cu_a340958gfkdj']);
	}
}