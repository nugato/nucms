<?php

namespace spec\Nugato\Bundle\NuCmsBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterConfiguration;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Nugato\Bundle\NuCmsBundle\EventListener\FileRemoveListener;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploaderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin FileRemoveListener
 */
class FileRemoveListenerSpec extends ObjectBehavior
{
    function let(FileUploaderInterface $fileUploader, CacheManager $cacheManager, FilterManager $filterManager)
    {
        $this->beConstructedWith($fileUploader, $cacheManager, $filterManager);
    }

    function it_remove_existing_file_using_file_uploader_and_remove_cached_images_for_image_type_file(
        LifecycleEventArgs $event,
        FileInterface $entity,
        FileUploaderInterface $fileUploader,
        CacheManager $cacheManager,
        FilterManager $filterManager,
        FilterConfiguration $filterConfiguration
    ): void {
        $entity->getPath()->willReturn('test.jpg');
        $entity->isImage()->willReturn(true);
        $event->getEntity()->willReturn($entity);
        $filterManager->getFilterConfiguration()->willReturn($filterConfiguration);
        $filterConfiguration->all()->willReturn(['xs' => 'thumbnalis']);

        $fileUploader->remove('test.jpg')->shouldBeCalled();
        $cacheManager->remove('test.jpg', ['xs'])->shouldBeCalled();

        $this->postRemove($event);
    }

    function it_remove_existing_file_using_file_uploader_without_clearing_images_cache_for_none_image_file_type(
        LifecycleEventArgs $event,
        FileInterface $entity,
        FileUploaderInterface $fileUploader,
        CacheManager $cacheManager
    ) {
        $entity->getPath()->willReturn('test.jpg');
        $entity->isImage()->willReturn(false);
        $event->getEntity()->willReturn($entity);

        $fileUploader->remove('test.jpg')->shouldBeCalled();
        $cacheManager->remove()->shouldNotBeCalled();

        $this->postRemove($event);
    }

    function it_do_nothing_for_not_file_entity(
        LifecycleEventArgs $event,
        \stdClass $object,
        FileUploaderInterface $fileUploader
    ): void {
        $event->getEntity()->willReturn($object);

        $fileUploader->remove(Argument::any())->shouldNotBeCalled();

        $this->postRemove($event);
    }
}
