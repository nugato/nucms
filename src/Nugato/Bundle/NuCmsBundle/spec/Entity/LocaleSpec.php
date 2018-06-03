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

use PhpSpec\ObjectBehavior;
use Sylius\Component\Locale\Model\Locale;
use Sylius\Component\Locale\Model\LocaleInterface;

class LocaleSpec extends ObjectBehavior
{
    function it_extends_a_base_locale_model(): void
    {
        $this->shouldHaveType(Locale::class);
    }

    function it_implements_a_locale_interface(): void
    {
        $this->shouldImplement(LocaleInterface::class);
    }
}
