<?php declare(strict_types = 1);

namespace Tests\Cases\Forms;

use Contributte\SeznamCaptcha\Forms\CaptchaContainer;
use Contributte\SeznamCaptcha\Forms\CaptchaHash;
use Contributte\SeznamCaptcha\Forms\CaptchaImage;
use Contributte\SeznamCaptcha\Forms\CaptchaInput;
use Ninjify\Nunjuck\Toolkit;
use Tester\Assert;
use Tests\Fixtures\FakeProviderFactory;
use Tests\Fixtures\FakeSeznamCaptcha;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function () {
	$factory = new FakeProviderFactory();
	$captcha = new CaptchaContainer($factory->create());
	Assert::type(CaptchaImage::class, $captcha['image']);
	Assert::type(CaptchaInput::class, $captcha['code']);
	Assert::type(CaptchaHash::class, $captcha['hash']);

	Assert::equal(FakeSeznamCaptcha::HASH, $captcha['hash']->getHash());
	Assert::equal(FakeSeznamCaptcha::IMAGE, $captcha['image']->getImage());
});

Toolkit::test(function () {
	$captcha = new CaptchaContainer(new FakeSeznamCaptcha($pass = true));
	$validator = $captcha->getValidator();

	// Always true, because of FakeSeznamCaptcha($pass)
	Assert::true($validator->validate('foo', 'bar'));
});


Toolkit::test(function () {
	$captcha = new CaptchaContainer(new FakeSeznamCaptcha($pass = false));
	$validator = $captcha->getValidator();

	// Always false, because of FakeSeznamCaptcha($pass)
	Assert::false($validator->validate('foo', 'bar'));
});
