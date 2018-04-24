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

namespace Nugato\Bundle\NuCmsBundle\Entity\Navigation;

use Sylius\Component\Taxonomy\Model\TaxonInterface;

interface NavigationItemInterface extends TaxonInterface
{
    /**
     * @param NavigationInterface $navigation
     */
    public function setNavigation(NavigationInterface $navigation): void;

    /**
     * @return NavigationInterface
     */
    public function getNavigation(): ?NavigationInterface;
}
