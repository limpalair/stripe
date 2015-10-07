<?php

namespace Limpalair\Stripe;

use Exception;
use Stripe\Stripe;
use Stripe\Charge as StripeCharge;
use Stripe\Customer as StripeCustomer;
use Illuminate\Support\Facades\Config;

class StripePortal
{
	/**
	 * Package version number
	 */
	const VERSION = "1.0.0";

	/**
	 * The currency
	 * 
	 * @var String
	 */
	protected static $currency = 'usd';
	
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

	/**
	 * Charge a Stripe customer
	 * 
	 * @return Stripe\Charge
	 */
	public function chargeStripeCustomer($amount, $options = [])
	{
		$options = array_merge([
			'currency' => $this->getCurrency(),
		], $options);

		$options['amount'] = $amount;

		if ( ! array_key_exists('source', $options) && array_key_exists('id', $options) ) {
			$options['source'] = $this->getStripeCustomerCard($options['id']);
		}

		try {
			$response StripeCharge::create($options);
		} catch(\Stripe\Error\Card $e) {
			\Log::error("Caught Stripe purchase failure: " . $e);
			return false;
		}

		return $response;
	}

	/**
	 * Get a Stripe customer card
	 * 
	 * @param  string $id
	 * @return Stripe\Collection
	 */
	public function getStripeCustomerCard($id = null)
	{
		if ( is_null($id) ) {
			throw new InvalidArgumentException("Retrieval of customer card failed due to null ID");
		}

		$customer = $this->getStripeCustomer($id);

		$card = $customer->sources->all([
			'limit' => '1',
			'object' => 'card'
		]);

		return $card;
	}

	/**
	 * Get currency
	 * 
	 * @return string 
	 */
	public function getCurrency()
	{
		return static::$currency;
	}


}