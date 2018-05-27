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

use Doctrine\ORM\Event\LifecycleEventArgs;
use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploaderInterface;

final class FileRemoveListener
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    public function __construct(FileUploaderInterface $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function postRemove(LifecycleEventArgs $event): void
    {
        $entity = $event->getEntity();

        if ($entity instanceof FileInterface) {
            $this->fileUploader->remove($entity->getPath());
        }
    }
}
