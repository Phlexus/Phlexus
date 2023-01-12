<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Libraries\Media\Files\Upload as MediaUpload;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Exception;

class MediaProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'media';

    /**
     * Register application service.
     *
     * @psalm-suppress UndefinedMethod
     *
     * @param array $parameters Custom parameters for Service Provider
     */
    public function register(array $parameters = []): void
    {
        $security = $this->di->getShared('security');

        $userDirectory = $security->getStaticUserToken();

        $this->di->setShared($this->providerName, function () use ($userDirectory) {
            try {
                return new MediaUpload();
            } catch (Exception $e) {
                return null;
            }
        });
    }
}
