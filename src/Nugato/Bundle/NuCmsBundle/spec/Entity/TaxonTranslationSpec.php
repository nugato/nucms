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

use PhpSpec\ObjectBehavior;
use Sylius\Component\Taxonomy\Model\TaxonTranslation;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;

class TaxonTranslationSpec extends ObjectBehavior
{
    function it_extends_a_base_taxon_translation_model(): void
    {
        $this->shouldHaveType(TaxonTranslation::class);
    }

    function it_implements_a_base_taxon_translation_interface(): void
    {
        $this->shouldImplement(TaxonTranslationInterface::class);
    }
}
