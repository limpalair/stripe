<?php

namespace Limpalair\Stripe\Contracts;

interface Stripe
{
	public function getStripeKey();

	public function setStripeKey();

	public function getVersion();

	public function setVersion();
}