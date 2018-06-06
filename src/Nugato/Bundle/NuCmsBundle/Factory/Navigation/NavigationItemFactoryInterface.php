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

namespace Nugato\Bundle\NuCmsBundle\Factory\Navigation;

use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationInterface;
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface NavigationItemFactoryInterface extends FactoryInterface
{
    /**
     * @param NavigationInterface $navigation
     * @param NavigationItemInterface|null $parent
     *
     * @return NavigationItemInterface
     */
    public function createForNavigation(
        NavigationInterface $navigation,
        ?NavigationItemInterface $parent
    ): NavigationItemInterface;
}
