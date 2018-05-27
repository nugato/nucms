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

namespace Nugato\Bundle\NuCmsBundle\Entity\File;

use Sylius\Component\Resource\Model\ResourceInterface;

interface FileInterface extends ResourceInterface
{
    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return null|string
     */
    public function getTitle(): ?string;

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void;

    /**
     * @return null|string
     */
    public function getExtension(): ?string;

    /**
     * @param string $path
     */
    public function setPath(string $path): void;

    /**
     * @return null|string
     */
    public function getPath(): ?string;

    /**
     * @param \SplFileInfo $file
     */
    public function setFile(\SplFileInfo $file): void;

    /**
     * @return null|\SplFileInfo
     */
    public function getFile(): ?\SplFileInfo;

    /**
     * @return bool
     */
    public function hasFile(): bool;
}
