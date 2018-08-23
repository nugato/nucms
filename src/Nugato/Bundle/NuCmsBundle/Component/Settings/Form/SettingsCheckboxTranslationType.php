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

use Nugato\Bundle\NuCmsBundle\Component\Settings\Form\DataTransformer\SettingsCheckboxContentDataTransformer;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

final class SettingsCheckboxTranslationType extends AbstractResourceType
{
    /**
     * @var SettingsCheckboxContentDataTransformer
     */
    private $transformer;

    public function __construct(
        string $dataClass,
        $validationGroups = [],
        SettingsCheckboxContentDataTransformer $transformer
    ) {
        parent::__construct($dataClass, $validationGroups);

        $this->transformer = $transformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', CheckboxType::class);

        $builder->get('content')->addModelTransformer($this->transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nucms_settings_checkbox_translation';
    }
}
