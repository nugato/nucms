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

use Gaufrette\Filesystem;
use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webmozart\Assert\Assert;

class FileUploader implements FileUploaderInterface
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var FilenameGeneratorInterface
     */
    private $filenameGenerator;

    /**
     * @param Filesystem $filesystem
     * @param FilenameGeneratorInterface $filenameGenerator
     */
    public function __construct(Filesystem $filesystem, FilenameGeneratorInterface $filenameGenerator)
    {
        $this->filesystem = $filesystem;
        $this->filenameGenerator = $filenameGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(FileInterface $file): void
    {
        if (!$file->hasFile()) {
            return;
        }

        /** @var UploadedFile $realFile */
        $realFile = $file->getFile();

        Assert::isInstanceOf($realFile, UploadedFile::class);

        if (null !== $file->getPath() && $this->filesystem->has($file->getPath())) {
            $this->remove($file->getPath());
        }

        $filename = $this->filenameGenerator->generate($realFile);

        $file->setPath($filename);
        $file->setExtension($realFile->getClientOriginalExtension());

        if (empty($file->getTitle())) {
            $file->setTitle($filename);
        }

        $this->filesystem->write(
            $file->getPath(),
            file_get_contents($file->getFile()->getPathname())
        );
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }
}
