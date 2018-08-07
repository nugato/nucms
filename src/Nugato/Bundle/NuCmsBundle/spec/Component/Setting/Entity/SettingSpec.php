<?php

namespace spec\Nugato\Bundle\NuCmsBundle\Component\Setting\Entity;

use Nugato\Bundle\NuCmsBundle\Component\Setting\Entity\Setting;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Setting
 */
class SettingSpec extends ObjectBehavior
{
    function it_extends_a_base_locale_model(): void
    {
        $this->shouldHaveType(Locale::class);
    }

    function it_implements_a_setting_interface(): void
    {
        $this->shouldImplement(SettingInterface::class);
    }
}
