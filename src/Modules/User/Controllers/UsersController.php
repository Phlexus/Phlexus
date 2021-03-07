<?php
declare(strict_types=1);

namespace Phlexus\Modules\User\Controllers;

use Phlexus\Modules\BaseUser\Models\Users;
use Phlexus\Modules\BaseUser\Controllers\AbstractController;
use Phlexus\Modules\Generic\Forms\BaseForm;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Select;
use Phlexus\Modules\BaseUser\Models\Profiles;

final class UsersController extends AbstractController
{
    use \Phlexus\Modules\Generic\Actions\CreateAction;
    use \Phlexus\Modules\Generic\Actions\EditAction;
    use \Phlexus\Modules\Generic\Actions\DeleteAction;
    use \Phlexus\Modules\Generic\Actions\ViewAction;
    use \Phlexus\Modules\Generic\Actions\SaveAction;

    public function initialize(): void
    {
        parent::initialize();

        $this->setModel(new Users);

        $form = new BaseForm();

        $formFields = [
            [
                'name' => 'email',
                'type' => Email::class,
                'required' => true
            ],
            [
                'name' => 'password',
                'type' => Password::class,
                'required' => true
            ],
            [
                'name' => 'profileId',
                'type' => Select::class,
                'required' => true,
                'related' => Profiles::class,
                'using' => ['id', 'name']
            ]
        ];

        $this->setFormFields($formFields);

        $form->setFields($this->parseFields($formFields));

        $this->setForm($form);

        $this->setViewFields(['email', 'profileId']);
    }
}
