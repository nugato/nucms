<?php

namespace spec\Nugato\Bundle\NuCmsBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
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
    function let(FileUploaderInterface $fileUploader)
    {
        $this->beConstructedWith($fileUploader);
    }

    function it_remove_existing_file_using_file_uploader(
        LifecycleEventArgs $event,
        FileInterface $entity,
        FileUploaderInterface $fileUploader
    ): void {
        $entity->getPath()->willReturn('test.jpg');
        $event->getEntity()->willReturn($entity);

        $fileUploader->remove('test.jpg')->shouldBeCalled();

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
