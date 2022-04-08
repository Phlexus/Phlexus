<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\User;
use Phlexus\Modules\BaseUser\Models\Profile;
use Phalcon\Http\ResponseInterface;

/**
 * Trait CreateAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait CreateAction
{
    use \Phlexus\Modules\Generic\Model;

    use \Phlexus\Modules\Generic\Form;

    /**
     * Create Action
     *
     * @return mixed ResponseInterface or void
     */
    public function createAction()
    {
        $defaultTranslation = $this->translation->setPage();

        $title = $defaultTranslation->setTypePage()->_('title-generic-create');

        $this->tag->appendTitle($title);
        
        $defaultRoute = $this->getBasePosition();

        $saveRoute =  $defaultRoute . '/save';

        $isAdmin = Profile::getUserProfile()->isAdmin();

        // Check if user has create permissions
        if (!$isAdmin) {
            $noPermissions = $defaultTranslation->setTypeMessage()->_('no-create-permissions');
            $this->flash->error($noPermissions);

            return $this->response->redirect($defaultRoute);
        }

        $this->view->setVar('form', $this->getForm());

        $this->view->setVar('defaultRoute', $defaultRoute);

        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->pick('generic/create');
    }
}