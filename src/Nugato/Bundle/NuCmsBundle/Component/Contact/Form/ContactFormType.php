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

namespace Nugato\Bundle\NuCmsBundle\Component\Contact\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;

final class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'nucms.web.form.contact_form.name',
                'required' => false,
                'constraints' => [new NotNull()]
            ])
            ->add('phone', TextType::class, ['label' => 'nucms.web.form.contact_form.phone'])
            ->add('email', EmailType::class, [
                'label' => 'nucms.web.form.contact_form.email',
                'required' => true,
                'constraints' => [new NotNull()],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'nucms.web.form.contact_form.message',
                'required' => true,
                'constraints' => [new NotNull()],
            ]);
    }
}
