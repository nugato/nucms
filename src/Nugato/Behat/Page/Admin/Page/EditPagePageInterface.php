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
     *
     * @return bool
     */
    public function isAlertsSuccessVisible(): bool;

    /**
     * Check equals value in slug input
     *
     * @param string $slug
     *
     * @return bool
     */
    public function isSlugHasValueInInput(string $slug): bool;
}
