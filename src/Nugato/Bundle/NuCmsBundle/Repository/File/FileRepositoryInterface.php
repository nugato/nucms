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

namespace Nugato\Bundle\NuCmsBundle\Repository\File;

use Sylius\Component\Resource\Repository\RepositoryInterface;

interface FileRepositoryInterface extends RepositoryInterface
{
    /**
     * @param array $ids
     */
    public function bulkRemove(array $ids): void;
}
