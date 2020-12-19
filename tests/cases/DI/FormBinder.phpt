<?php declare(strict_types = 1);

namespace Tests\Cases\DI;

use Contributte\SeznamCaptcha\DI\FormBinder;
use Contributte\SeznamCaptcha\Forms\CaptchaContainer;
use Contributte\SeznamCaptcha\Forms\CaptchaHash;
use Contributte\SeznamCaptcha\Forms\CaptchaImage;
use Contributte\SeznamCaptcha\Forms\CaptchaInput;
use Nette\Forms\Form;
use Ninjify\Nunjuck\Toolkit;
use Tester\Assert;
use Tests\Fixtures\FakeProviderFactory;
use Tests\Fixtures\FakeSeznamCaptcha;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function () {
	$factory = new FakeProviderFactory();
	FormBinder::bind($factory);

	$form = new Form();
	$captcha = $form->addCaptcha();

	Assert::type(CaptchaContainer::class, $captcha);
	Assert::type(CaptchaImage::class, $captcha['image']);
	Assert::type(CaptchaInput::class, $captcha['code']);
	Assert::type(CaptchaHash::class, $captcha['hash']);

	Assert::equal(FakeSeznamCaptcha::HASH, $captcha['hash']->getHash());
	Assert::equal(FakeSeznamCaptcha::IMAGE, $captcha['image']->getImage());
});
