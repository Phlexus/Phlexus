<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Class Home
 *
 * @package Phlexus\Modules\Landing\Controllers
 */
final class HomeController extends Controller
{
    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-home');

        $this->tag->setTitle($title);
    }
}
