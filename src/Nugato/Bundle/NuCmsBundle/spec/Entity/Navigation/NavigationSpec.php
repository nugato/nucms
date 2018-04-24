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

use Nugato\Bundle\NuCmsBundle\Entity\Navigation\Navigation;
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationInterface;
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
}
