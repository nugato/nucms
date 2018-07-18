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

namespace Nugato\Bundle\NuCmsBundle\Component\Navigation\Repository;

use Sylius\Component\Resource\Repository\RepositoryInterface;

interface NavigationItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $navigationId
     * @param string $locale
     *
     * @return array
     */
    public function getTreeByNavigationAndLocale(string $navigationId, string $locale): array;
}
