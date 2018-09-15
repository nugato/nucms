<?php

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Form\DataTransformer;

use Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject\SettingsType;
use Symfony\Component\Form\DataTransformerInterface;

final class SettingsTypeDataTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        return new SettingsType($value);
    }
}
