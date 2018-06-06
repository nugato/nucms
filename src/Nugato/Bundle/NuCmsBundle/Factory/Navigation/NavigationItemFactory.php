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

final class NavigationItemFactory implements NavigationItemFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): NavigationItemInterface
    {
        return $this->factory->createNew();
    }

    /**
     * {@inheritdoc}
     */
    public function createForNavigation(
        NavigationInterface $navigation,
        ?NavigationItemInterface $parent
    ): NavigationItemInterface {
        $navigationItem = $this->createNew();
        $navigationItem->setNavigation($navigation);

        if (!is_null($parent)) {
            $navigationItem->setParent($parent);
        }

        return $navigationItem;
    }
}
