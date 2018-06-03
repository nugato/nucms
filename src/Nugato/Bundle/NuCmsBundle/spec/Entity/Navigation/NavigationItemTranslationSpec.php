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

namespace spec\Nugato\Bundle\NuCmsBundle\Entity\Navigation;

use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemTranslation;
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemTranslationInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Taxonomy\Model\TaxonTranslation;

/**
 * @mixin NavigationItemTranslation
 */
class NavigationItemTranslationSpec extends ObjectBehavior
{
    function it_should_implement_navigation_item_translation_interface()
    {
        $this->shouldImplement(NavigationItemTranslationInterface::class);
    }

    function it_has_all_fields_mutable(): void
    {
        $this->setName('Name');
        $this->getName()->shouldReturn('Name');

        $this->setUrl('Url');
        $this->getUrl()->shouldReturn('Url');
    }
}
