<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Taxon\Repository;

use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface as BaseTaxonRepositoryInterface;

interface TaxonRepositoryInterface extends BaseTaxonRepositoryInterface
{
    public function findAllByParentCode(string $parentCode, ?string $locale = null, int $limit = 10, int $page = 1): iterable;
}
