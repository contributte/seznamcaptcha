# SeznamCaptcha

## Content

- [Usage - how to register](#usage)
- [Extension - how to configure](#configuration)
- [Form - setup nette form](#form)
- [Rendering - auto vs manual](#rendering)
- [Example - advanced example](#example)

## Usage

```yaml
extensions:
    captcha: Contributte\SeznamCaptcha\DI\SeznamCaptchaExtension
```

## Configuration

By default is `auto: on` and `method: http`, you can disable it and bind addCaptcha to your forms by yourself.

```yaml
captcha:
    auto: off # on | off
    method: xmlrpc # http | xmlrpc
```

## Form

![captcha](https://raw.githubusercontent.com/contributte/seznamcaptcha/master/.docs/captcha.png)

Just register an extension and keep `auto` argument as it is.

```php
use Nette\Application\UI\Form;

protected function createComponentForm()
{
    $form = new Form();

    $form->addCaptcha('captcha')
        ->setRequired('Are you robot?');

    $form->addSubmit('send');

    $form->onSuccess[] = function (Form $form) {
        dump($form['captcha']);
    };

    return $form;
}
```

## Rendering

### Automatic

```latte
{control form}
````

### Manual

It needs a `CaptchaContainer` consists of 2 inputs `image` and `code`.

```latte
<form n:name="form">
    {input captcha-image}
    {input captcha-code}
</form>
```

## Example

```php
use Minetro\SeznamCaptcha\Forms\CaptchaHash;
use Minetro\SeznamCaptcha\Forms\CaptchaImage;
use Minetro\SeznamCaptcha\Forms\CaptchaInput;
use Minetro\SeznamCaptcha\Provider\CaptchaValidator;
use Minetro\SeznamCaptcha\Provider\ProviderFactory;
use Nette\Application\UI\Form;

/** @var ProviderFactory @inject */
public $providerFactory;

protected function createComponentForm()
{
    $form = new Form();

    $provider = $this->providerFactory->create();
    $form['image'] = new CaptchaImage('Captcha', $provider);
    $form['hash'] = new CaptchaHash($provider);
    $form['code'] = new CaptchaInput('Code');

    $form->addSubmit('send');

    $form->onValidate[] = function (Form $form) use ($provider) {
        $validator = new CaptchaValidator($provider);

        $hash = $form['hash']->getHttpHash();
        $code = $form['code']->getHttpCode();

        if ($validator->validate($code, $hash) !== TRUE) {
            $form->addError('Are you robot?');
        }
    };

    $form->onSuccess[] = function (Form $form) {
        dump($form);
    };

    return $form;
}
```

For better usability add this functionality to your `BaseForms`, `BaseFormFactory` or
something like this.

You can also create a trait for it.
