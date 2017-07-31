<?php

namespace Tests\Helpers;

use Contributte\SeznamCaptcha\Provider\ProviderFactory;

final class FakeProviderFactory implements ProviderFactory
{

	/**
	 * @return FakeSeznamCaptcha
	 */
	public function create()
	{
		return new FakeSeznamCaptcha();
	}

}
