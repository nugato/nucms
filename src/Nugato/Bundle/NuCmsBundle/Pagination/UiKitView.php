<?php

/*
 * This file is part of the NuCms package.
 *
 * (c) Jacek Bednarek
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Pagination;

use Nugato\Bundle\NuCmsBundle\Pagination\Template\UiKitTemplate;
use Pagerfanta\View\DefaultView;

class UiKitView extends DefaultView
{
    protected function createDefaultTemplate()
    {
        return new UiKitTemplate();
    }

    protected function getDefaultProximity()
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ui_kit';
    }
}
