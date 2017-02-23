# SeznamCaptcha

## Advanced

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
