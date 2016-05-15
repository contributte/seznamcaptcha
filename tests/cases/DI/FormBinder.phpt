<?php

/**
 * Test: DI\FormBinder
 */

use Minetro\SeznamCaptcha\DI\FormBinder;
use Minetro\SeznamCaptcha\Forms\CaptchaContainer;
use Minetro\SeznamCaptcha\Forms\CaptchaHash;
use Minetro\SeznamCaptcha\Forms\CaptchaImage;
use Minetro\SeznamCaptcha\Forms\CaptchaInput;
use Nette\Forms\Form;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

test(function () {
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
