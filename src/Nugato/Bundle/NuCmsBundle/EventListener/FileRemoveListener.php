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
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploaderInterface;

final class FileRemoveListener
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * @var CacheManager
     */
    private $cacheManager;

    /**
     * @var FilterManager
     */
    private $filterManager;

    public function __construct(
        FileUploaderInterface $fileUploader,
        CacheManager $cacheManager,
        FilterManager $filterManager
    ) {
        $this->fileUploader = $fileUploader;
        $this->cacheManager = $cacheManager;
        $this->filterManager = $filterManager;
    }

    public function postRemove(LifecycleEventArgs $event): void
    {
        $entity = $event->getEntity();

        if ($entity instanceof FileInterface) {
            $this->fileUploader->remove($entity->getPath());

            if ($entity->isImage()) {
                $this->cacheManager->remove(
                    $entity->getPath(),
                    array_keys($this->filterManager->getFilterConfiguration()->all())
                );
            }
        }
    }
}
