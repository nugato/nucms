<?php

namespace spec\Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject;

use Nugato\Bundle\NuCmsBundle\Component\Settings\Exception\InvalidSettingsTypeException;
use Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject\SettingsType;
use PhpSpec\ObjectBehavior;

final class SettingsTypeSpec extends ObjectBehavior
{
    function it_validate_value_of_type(): void
    {
        $this->beConstructedWith('wrong_type');

        $this->shouldThrow(InvalidSettingsTypeException::class)->duringInstantiation();
    }

    function it_allow_to_create_type_with_defined_values()
    {
        $typeInput = new SettingsType('input');
        $typeCheckbox = new SettingsType('checkbox');

        $this->shouldNotThrow(InvalidSettingsTypeException::class)->duringInstantiation();
    }

    function it_is_immutable_value_object(): void
    {
        $this->beConstructedWith('input');

        $this->getValue()->shouldReturn('input');
    }
}
