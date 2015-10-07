<?php
namespace Limpalair\Stripe;

use Illuminate\Support\Facades\Facade;

class StripeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'stripeportal';
    }
}