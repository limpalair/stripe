<?php

namespace Limpalair\Stripe;

use Exception;
use Stripe\Stripe;
use Illuminate\Support\Facades\Config;

class StripePortal
{
	/**
	 * Package version number
	 */
	const VERSION = "1.0.0";

	/**
	 * The Stripe API key
	 * 
	 * @var string
	 */
	protected static $stripeKey;
	
	/**
	 * Create a new Stripe instance
	 *
	 * @return  void
	 */
	public function __construct()
	{
		Stripe::setApiKey($this->getStripeKey());

		$customer = \Stripe\Customer::create(array(
	      'email' => 'customer@example.com',
		));

	}

	/**
	 * Get the Stripe API key
	 * 
	 * @return string
	 */
	public function getStripeKey()
	{
		if ( empty(Config::get('services.stripe.secret')) )
			throw new InvalidArgumentException('Stripe API key not properly configured');

		return Config::get('services.stripe.secret');

	}
}