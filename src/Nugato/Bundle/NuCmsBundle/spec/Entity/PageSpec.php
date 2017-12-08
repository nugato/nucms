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

use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

class PageSpec extends ObjectBehavior
{
    function let()
    {
        $this->setCurrentLocale('en_US');
        $this->setFallbackLocale('en_US');
    }

    function it_implements_all_needed_interface(): void
    {
        $this->shouldImplement(PageInterface::class);
        $this->shouldImplement(ResourceInterface::class);
        $this->shouldImplement(TranslatableInterface::class);
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
