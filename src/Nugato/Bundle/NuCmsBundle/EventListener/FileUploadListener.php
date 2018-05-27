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

namespace Nugato\Bundle\NuCmsBundle\EventListener;

use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class FileUploadListener
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    public function __construct(FileUploaderInterface $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function uploadFile(GenericEvent $event): void
    {
        $subject = $event->getSubject();

        Assert::isInstanceOf($subject, FileInterface::class);

        $this->uploadSubjectFile($subject);
    }

    private function uploadSubjectFile(FileInterface $file): void
    {
        if ($file->hasFile()) {
            $this->fileUploader->upload($file);
        }
    }
}
