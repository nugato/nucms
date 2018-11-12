<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Form;

use Nugato\Bundle\NuCmsBundle\Entity\File\File;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonAutocompleteChoiceType;
use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonTranslationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class TaxonType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add(
                'image',
                EntityType::class,
                [
                    'class' => File::class,
                    'choice_label' => 'title',
                    'label' => 'nucms.ui.image',
                    'required' => false,
                ]
            )
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event): void {
                    if (null === $event->getData()) {
                        return;
                    }

                    $event->getForm()->add(
                        'parent',
                        TaxonAutocompleteChoiceType::class,
                        [
                            'label' => 'sylius.form.taxon.parent',
                            'required' => false,
                        ]
                    );
                }
            )
            ->add(
                'translations',
                ResourceTranslationsType::class,
                [
                    'entry_type' => TaxonTranslationType::class,
                    'label' => 'sylius.form.taxon.name',
                ]
            );
    }

    public function getBlockPrefix(): string
    {
        return 'nucms_taxon';
    }
}
