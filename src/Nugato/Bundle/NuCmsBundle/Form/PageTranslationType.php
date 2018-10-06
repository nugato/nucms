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

namespace Nugato\Bundle\NuCmsBundle\Form;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class PageTranslationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'nucms.ui.title'])
            ->add('content', TextareaType::class, ['label' => 'nucms.ui.content'])
            ->add('slug', TextType::class, ['label' => 'nucms.ui.slug'])
            ->add('metaTitle', TextType::class, ['label' => 'nucms.ui.meta_title'])
            ->add('metaDescription', TextType::class, ['label' => 'nucms.ui.meta_description'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nucms_page_translation';
    }
}
