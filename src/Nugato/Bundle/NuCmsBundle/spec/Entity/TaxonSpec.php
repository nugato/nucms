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
use Sylius\Component\Taxonomy\Model\Taxon;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

class TaxonSpec extends ObjectBehavior
{
    function it_extends_a_base_Taxon_model(): void
    {
        $this->shouldHaveType(Taxon::class);
    }

    function it_implements_a_Taxon_interface(): void
    {
        $this->shouldImplement(TaxonInterface::class);
    }
}
