<?php declare(strict_types = 1);

namespace Tests\Fixtures;

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
