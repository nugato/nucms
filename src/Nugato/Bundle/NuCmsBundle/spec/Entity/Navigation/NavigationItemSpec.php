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

namespace spec\Nugato\Bundle\NuCmsBundle\Entity\Navigation;

use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationInterface;
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItem;
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Taxonomy\Model\Taxon;

/**
 * @mixin NavigationItem
 */
class NavigationItemSpec extends ObjectBehavior
{
    function let()
    {
        $this->setCurrentLocale('en_US');
        $this->setFallbackLocale('en_US');
    }

    function it_should_implement_navigation_item_interface()
    {
        $this->shouldImplement(NavigationItemInterface::class);
    }

    function it_has_all_fields_mutable(NavigationInterface $navigation): void
    {
        $this->setNavigation($navigation);
        $this->getNavigation()->shouldReturn($navigation);

        $this->setName('Name');
        $this->getName()->shouldReturn('Name');
    }
}
