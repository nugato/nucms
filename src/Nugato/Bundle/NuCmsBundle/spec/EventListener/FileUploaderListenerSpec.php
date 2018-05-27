<?php

namespace spec\Nugato\Bundle\NuCmsBundle\EventListener;

use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Nugato\Bundle\NuCmsBundle\EventListener\FileUploaderListener;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploaderInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @mixin FileUploaderListener
 */
class FileUploaderListenerSpec extends ObjectBehavior
{
    function let(FileUploaderInterface $fileUploader)
    {
        $this->beConstructedWith($fileUploader);
    }

    function it_throws_exception_if_subject_is_not_a_file_interface(GenericEvent $event, \stdClass $object)
    {
        $event->getSubject()->willReturn($object);

        $this->shouldThrow(\InvalidArgumentException::class)->during('uploadFile', [$event]);
    }

    function it_upload_exists_file_using_file_uploader(
        FileUploaderInterface $fileUploader,
        GenericEvent $event,
        FileInterface $subject
    ) {
        $subject->hasFile()->willReturn(true);
        $event->getSubject()->willReturn($subject);

        $fileUploader->upload($subject)->shouldBeCalled();

        $this->uploadFile($event);
    }

    function it_will_not_upload_a_file_if_file_does_not_exist(
        FileUploaderInterface $fileUploader,
        GenericEvent $event,
        FileInterface $subject
    ) {
        $subject->hasFile()->willReturn(false);
        $event->getSubject()->willReturn($subject);

        $fileUploader->upload($subject)->shouldNotBeCalled();

        $this->uploadFile($event);
    }
}
