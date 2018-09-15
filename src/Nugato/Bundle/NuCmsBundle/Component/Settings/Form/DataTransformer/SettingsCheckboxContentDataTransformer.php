<?php

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

final class SettingsCheckboxContentDataTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return ($value === 'true') ? true : false;
    }

    public function reverseTransform($value)
    {
        return json_encode((bool)$value);
    }
}
