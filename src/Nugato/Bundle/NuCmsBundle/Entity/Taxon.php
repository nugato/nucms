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

namespace Nugato\Bundle\NuCmsBundle\Entity;

use Nugato\Bundle\NuCmsBundle\Core\Entity\ImageAwareInterface;
use Nugato\Bundle\NuCmsBundle\Core\Entity\ImageAwareTrait;
use Sylius\Component\Taxonomy\Model\Taxon as BaseTaxon;

class Taxon extends BaseTaxon implements ImageAwareInterface
{
    use ImageAwareTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setPosition(0);
    }
}
