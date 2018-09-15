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

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Form;

use Nugato\Bundle\NuCmsBundle\Component\Settings\Entity\Settings;
use Nugato\Bundle\NuCmsBundle\Component\Settings\Form\DataTransformer\SettingsTypeDataTransformer;
use Nugato\Bundle\NuCmsBundle\Component\Settings\Form\Type\SettingsTypeType;
use Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject\SettingsType as SettingsTypeVo;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\FormBuilderInterface;

final class SettingsType extends AbstractResourceType
{
    /**
     * @var SettingsTypeDataTransformer
     */
    private $settingsTypeDataTransformer;

    public function __construct(
        string $dataClass,
        $validationGroups = [],
        SettingsTypeDataTransformer $settingsTypeDataTransformer
    ) {
        parent::__construct($dataClass, $validationGroups);

        $this->settingsTypeDataTransformer = $settingsTypeDataTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new AddCodeFormSubscriber());

        if (is_null($options['data']->getId())) {
            $builder->add('type', SettingsTypeType::class);

            $builder->get('type')->addModelTransformer($this->settingsTypeDataTransformer);
        } else {
            /** @var Settings $settings */
            $settings = $options['data'];

            $builder->add(
                'translations',
                ResourceTranslationsType::class,
                [
                    'entry_type' => $this->getTranslationFormEntryType($settings->getType()),
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nucms_settings';
    }

    private function getTranslationFormEntryType(SettingsTypeVo $settingsType): string
    {
        switch ($settingsType) {
            case SettingsTypeVo::TYPE_INPUT:
                return SettingsInputTranslationType::class;
            case SettingsTypeVo::TYPE_CHECKBOX:
                return SettingsCheckboxTranslationType::class;
            default:
                return SettingsInputTranslationType::class;
        }
    }
}
