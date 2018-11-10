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

class File implements FileInterface
{
    const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'gif', 'png'];

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var \SplFileInfo
     */
    protected $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    public function getExtension(): ?string
    {
        return ($this->extension !== null) ? strtolower($this->extension) : null;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setFile(\SplFileInfo $file): void
    {
        $this->file = $file;
    }

    public function getFile(): ?\SplFileInfo
    {
        return $this->file;
    }

    public function hasFile(): bool
    {
        return null !== $this->file;
    }

    public function isImage(): bool
    {
        return \in_array($this->getExtension(), self::IMAGE_EXTENSIONS, true);
    }
}
