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

namespace spec\Nugato\Bundle\NuCmsBundle\Component\Navigation\Entity;

use Nugato\Bundle\NuCmsBundle\Component\Navigation\Entity\Navigation;
use Nugato\Bundle\NuCmsBundle\Component\Navigation\Entity\NavigationInterface;
use Nugato\Bundle\NuCmsBundle\Component\Navigation\Entity\NavigationItemInterface;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Navigation
 */
class NavigationSpec extends ObjectBehavior
{
    function it_implements_a_navigation_interface(): void
    {
        $this->shouldImplement(NavigationInterface::class);
    }

    function it_has_all_fields_mutable(): void
    {
        $this->setCode('Code');
        $this->getCode()->shouldReturn('Code');

        $this->setName('Name');
        $this->getName()->shouldReturn('Name');

        $createdAt = new \DateTime('1991.10.01');
        $this->setCreatedAt($createdAt);
        $this->getCreatedAt()->shouldReturn($createdAt);

        $updatedAt = new \DateTime('1991.10.02');
        $this->setUpdatedAt($updatedAt);
        $this->getUpdatedAt()->shouldReturn($updatedAt);
    }

    function it_can_manage_items(NavigationItemInterface $item1, NavigationItemInterface $item2)
    {
        $this->hasItem($item1)->shouldReturn(false);
        $this->hasItems()->shouldReturn(false);

        $this->addItem($item1);
        $this->addItem($item1);
        $this->addItem($item2);
        $this->hasItem($item1)->shouldReturn(true);
        $this->hasItem($item2)->shouldReturn(true);
        $this->hasItems()->shouldReturn(true);
        $this->getItems()->shouldHaveCount(2);
        $this->getItems()->shouldContain($item1);
        $this->getItems()->shouldContain($item2);

        $this->removeItem($item1);
        $this->removeItem($item2);
        $this->hasItem($item1)->shouldReturn(false);
        $this->hasItem($item2)->shouldReturn(false);
        $this->hasItems()->shouldReturn(false);
        $this->getItems()->shouldHaveCount(0);
    }
}
