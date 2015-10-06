<?php

namespace Limpalair\Stripe;

use Limpalair\Stripe\Contracts\Stripe as StripeContract;

class Stripe
{
	/**
	 * The stripe instance
	 * 
	 * @var \Limpalair\Stripe\Contracts\StripeContract
	 */
	protected $stripe;

	public function __construct(StripeContract as $stripe)
	{
		//
	}
}