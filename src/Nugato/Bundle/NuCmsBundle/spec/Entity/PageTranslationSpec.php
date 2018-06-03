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

namespace spec\Nugato\Bundle\NuCmsBundle\Entity;

use Nugato\Bundle\NuCmsBundle\Entity\PageTranslationInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

class PageTranslationSpec extends ObjectBehavior
{
    function it_implements_a_page_and_resource_interface(): void
    {
        $this->shouldImplement(PageTranslationInterface::class);
        $this->shouldImplement(TranslationInterface::class);
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_has_all_fields_mutable(): void
    {
        $this->setTitle('Title');
        $this->getTitle()->shouldReturn('Title');

        $this->setContent('Content');
        $this->getContent()->shouldReturn('Content');

        $this->setSlug('Slug');
        $this->getSlug()->shouldReturn('Slug');
    }
}
