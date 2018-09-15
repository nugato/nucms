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

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Form\Type;

use Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject\SettingsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SettingsTypeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'choices' => [
                    'nucms.form.settings.type.input' => SettingsType::TYPE_INPUT,
                    'nucms.form.settings.type.checkbox' => SettingsType::TYPE_CHECKBOX,
                ],
            ]
        );
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
