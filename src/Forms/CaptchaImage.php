<?php

namespace Contributte\SeznamCaptcha\Forms;

use Contributte\SeznamCaptcha\Provider\CaptchaProvider;
use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;

class CaptchaImage extends BaseControl
{

	/** @var CaptchaProvider */
	private $provider;

	/**
	 * @param string $label
	 * @param CaptchaProvider $provider
	 */
	public function __construct($label, CaptchaProvider $provider)
	{
		parent::__construct($label);
		$this->provider = $provider;

		$this->control = Html::el('img');
		$this->control->addClass('captcha-image seznam-captcha-image');
	}

	/**
	 * @return string
	 */
	public function getImage()
	{
		return $this->provider->getImage();
	}

	/**
	 * @return Html
	 */
	public function getControl()
	{
		$img = parent::getControl();
		$img->addAttributes([
			'src' => $this->getImage(),
		]);

		return $img;
	}

}
