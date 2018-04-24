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

use Sylius\Component\Taxonomy\Model\Taxon;

class NavigationItem extends Taxon implements NavigationItemInterface
{
    /**
     * @var NavigationInterface
     */
    protected $navigation;

    public function __construct()
    {
        parent::__construct();

        $this->setPosition(0);
    }

    /**
     * {@inheritdoc}
     */
    public function setNavigation(NavigationInterface $navigation): void
    {
        $this->navigation = $navigation;
    }

    /**
     * {@inheritdoc}
     */
    public function getNavigation(): ?NavigationInterface
    {
        return $this->navigation;
    }
}
