<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Forms;

use Contributte\SeznamCaptcha\Provider\CaptchaProvider;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Form;

class CaptchaHash extends HiddenField
{

	/** @var CaptchaProvider */
	private $provider;

	public function __construct(CaptchaProvider $provider)
	{
		parent::__construct($provider->getHash());
		$this->provider = $provider;
	}

	public function getHash(): string
	{
		return $this->provider->getHash();
	}

	public function getHttpHash(): string
	{
		return $this->getHttpData(Form::DATA_LINE);
	}

}
