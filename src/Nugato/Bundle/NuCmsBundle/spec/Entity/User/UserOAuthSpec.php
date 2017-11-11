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

namespace spec\Nugato\Bundle\NuCmsBundle\Entity\User;

use PhpSpec\ObjectBehavior;
use Sylius\Component\User\Model\UserOAuth;
use Sylius\Component\User\Model\UserOAuthInterface;

class UserOAuthSpec extends ObjectBehavior
{
    function it_extends_a_base_user_oauth_model(): void
    {
        $this->shouldHaveType(UserOAuth::class);
    }

    function it_implements_a_user_interface(): void
    {
        $this->shouldImplement(UserOAuthInterface::class);
    }
}
