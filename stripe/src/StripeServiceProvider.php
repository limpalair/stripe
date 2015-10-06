<?php

namespace Limpalair\Stripe;

use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{

	public function boot()
	{
		//
	}

	public function register()
	{
		$this->app->bind('Limpalair\Stripe', function($app) {
			return new Limpalair\Stripe();
		})
	}

}