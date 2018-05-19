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

namespace Nugato\Bundle\NuCmsBundle\Service\File;

use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;

interface FileUploaderInterface
{
    /**
     * @param FileInterface $file
     */
    public function upload(FileInterface $file): void;

    /**
     * @param string $path
     *
     * @return bool
     */
    public function remove(string $path): bool;
}
