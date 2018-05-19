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

use Nugato\Bundle\NuCmsBundle\Service\File\FilenameGeneratorInterface;
use Nugato\Bundle\NuCmsBundle\Service\File\NameWithUniqueFilenameGenerator;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @mixin NameWithUniqueFilenameGenerator
 */
class NameWithUniqueFilenameGeneratorSpec extends ObjectBehavior
{
    function it_should_implement_filename_generator_interface()
    {
        $this->shouldImplement(FilenameGeneratorInterface::class);
    }

    function it_should_generate_unique_filename(File $file)
    {
        $file->getFilename()->willReturn('foo');
        $file->guessExtension()->willReturn('jpg');

        $filename = $this->generate($file);

        $filename->shouldStartWith('foo');
        $filename->shouldEndWith('.jpg');
    }
}
