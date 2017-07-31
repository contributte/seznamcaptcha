<?php

namespace Contributte\SeznamCaptcha\Forms;

use Contributte\SeznamCaptcha\Provider\CaptchaProvider;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Form;

class CaptchaHash extends HiddenField
{

	/** @var CaptchaProvider */
	private $provider;

	/**
	 * @param CaptchaProvider $provider
	 */
	public function __construct(CaptchaProvider $provider)
	{
		parent::__construct($provider->getHash());
		$this->provider = $provider;
	}

	/**
	 * @return string
	 */
	public function getHash()
	{
		return $this->provider->getHash();
	}

	/**
	 * @return string
	 */
	public function getHttpHash()
	{
		return $this->getHttpData(Form::DATA_LINE);
	}

}
