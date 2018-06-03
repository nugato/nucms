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

namespace spec\Nugato\Bundle\NuCmsBundle\Service\File;

use Gaufrette\Filesystem;
use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use Nugato\Bundle\NuCmsBundle\Service\File\FilenameGeneratorInterface;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploader;
use Nugato\Bundle\NuCmsBundle\Service\File\FileUploaderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @mixin FileUploader
 */
class FileUploaderSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem, FileInterface $file, FilenameGeneratorInterface $filenameGenerator): void
    {
        $filesystem->has(Argument::any())->willReturn(false);
        $realFile = new UploadedFile(__FILE__, 'foo.jpg');

        $file->getFile()->willReturn($realFile);
        $this->beConstructedWith($filesystem, $filenameGenerator);
    }

    function it_implement_file_uploader_interface(): void
    {
        $this->shouldImplement(FileUploaderInterface::class);
    }

    function it_uploads_a_file(
        Filesystem $filesystem,
        FileInterface $file,
        FilenameGeneratorInterface $filenameGenerator
    ): void {
        $file->hasFile()->willReturn(true);
        $file->getPath()->willReturn('123-foo.jpg');

        $filesystem->has('foo.jpg')->willReturn(false);
        $filesystem->delete(Argument::any())->shouldNotBeCalled();

        $filenameGenerator->generate(Argument::type(UploadedFile::class))->willReturn('123-foo.jpg');
        $filenameGenerator->generate(Argument::type(UploadedFile::class))->shouldBeCalled();

        $file->setPath('123-foo.jpg')->shouldBeCalled();
        $file->getTitle()->willReturn(null);
        $file->setTitle('123-foo.jpg')->shouldBeCalled();
        $file->setExtension('jpg')->shouldBeCalled();

        $filesystem->write('123-foo.jpg', Argument::type('string'))->shouldBeCalled();

        $this->upload($file);
    }
}
