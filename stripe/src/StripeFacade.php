<?php
namespace Limpalair\Stripe;

use Illuminate\Support\Facades\Facade;

class StripeFacade extends Facade
{
	/**
	 * Get the registered name of the component
	 * 
	 * @return string
	 */
    protected static function getFacadeAccessor()
    {
        return 'stripeportal';
    }
}