<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Taxon\Entity;

use Nugato\Bundle\NuCmsBundle\Core\Entity\ImageAwareTrait;
use Sylius\Component\Taxonomy\Model\Taxon as BaseTaxon;

class Taxon extends BaseTaxon implements TaxonInterface
{
    use ImageAwareTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setPosition(0);
    }
}
