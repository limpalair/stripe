<?php

namespace Limpalair\Stripe;

use Exception;
use Stripe\Stripe;
use Stripe\Customer as StripeCustomer;
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

	/**
	 * Create a new customer
	 * 
	 * @param  array  $params
	 * @return Stripe\Customer
	 */
	public function createStripeCustomer($params = [])
	{
		$customer = StripeCustomer::create($params);

		return $this->getStripeCustomer($customer->id);
	}

	/**
	 * Get Stripe customer's information
	 * 
	 * @param  string $id
	 * @return Stripe\Customer
	 */
	public function getStripeCustomer($id = null)
	{
		return StripeCustomer::retrieve($id);
	}

}