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

namespace Nugato\Behat\Page\Admin\Page;

interface EditPagePageInterface
{
    /**
     * Check is alerts with success message is visible
     */
    public function isAlertsSuccessVisible();
}
