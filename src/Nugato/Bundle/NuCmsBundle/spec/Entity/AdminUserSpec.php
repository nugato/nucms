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

namespace spec\Nugato\Bundle\NuCmsBundle\Entity;

use Nugato\Bundle\NuCmsBundle\Entity\AdminUserInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\User\Model\User;
use Sylius\Component\User\Model\UserInterface;

class AdminUserSpec extends ObjectBehavior
{
    function it_extends_a_base_user_model(): void
    {
        $this->shouldHaveType(User::class);
    }

    function it_implements_an_admin_user_interface(): void
    {
        $this->shouldImplement(AdminUserInterface::class);
    }

    function it_implements_a_user_interface(): void
    {
        $this->shouldImplement(UserInterface::class);
    }

    function it_has_all_fields_mutable(): void
    {
        $this->setFirstName('John');
        $this->getFirstName()->shouldReturn('John');

        $this->setLastName('Doe');
        $this->getLastName()->shouldReturn('Doe');

        $this->setLocaleCode('en');
        $this->getLocaleCode()->shouldReturn('en');
    }
}
