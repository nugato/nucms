<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Taxon\Entity;

use Nugato\Bundle\NuCmsBundle\Core\Entity\ImageAwareInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface as BaseTaxonInterface;

interface TaxonInterface extends BaseTaxonInterface, ImageAwareInterface
{

}
