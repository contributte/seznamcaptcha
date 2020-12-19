<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Forms;

use Contributte\SeznamCaptcha\Provider\CaptchaProvider;
use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;

class CaptchaImage extends BaseControl
{

	/** @var CaptchaProvider */
	private $provider;

	public function __construct(string $label, CaptchaProvider $provider)
	{
		parent::__construct($label);
		$this->provider = $provider;

		$this->control = Html::el('img');
		$this->control->addClass('captcha-image seznam-captcha-image');
	}

	public function getImage(): string
	{
		return $this->provider->getImage();
	}

	public function getControl(): Html
	{
		$img = parent::getControl();

		assert($img instanceof Html);

		$img->addAttributes([
			'src' => $this->getImage(),
		]);

		return $img;
	}

}
