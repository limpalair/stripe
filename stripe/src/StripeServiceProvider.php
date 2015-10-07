<?php

namespace Limpalair\Stripe;

use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
	/**
	 * Boostrap application events
	 * 
	 * @return void 
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the service provider
	 * 
	 * @return void 
	 */
	public function register()
	{
		$this->app->bind('stripeportal', function($app) {
			return new StripePortal();
		});
	}

}