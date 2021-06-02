<?php

namespace Phlexus\Modules\Generic\Forms;

use Phlexus\Form\FormBase;
use Phlexus\Forms\Validators\CaptchaValidator;


/**
 * @property Security $security
 */
abstract class CaptchaForm extends FormBase
{

    // CAPTCHA name
    const CAPTCHA_NAME = 'captcha';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $configs = Helpers::phlexusConfig('captcha')->toArray();

        $this->assignCaptcha($configs['options']['site-key']);
    }

    /**
     * Assign Captcha
     * 
     * @param string $data_site_key Captcha Site Key 
     * 
     * @return void
     */
    private function assignCaptcha($data_site_key) {
        $captcha = new Hidden(self::CAPTCHA_NAME, [
            'class' => 'g-recaptcha',
            'data-site-key' => 'key'
        ]);

        $captcha->addValidator(new CaptchaValidator());

        $this->add($captcha);
    }
}
