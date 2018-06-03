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

namespace spec\Nugato\Bundle\NuCmsBundle\Entity\File;

use Nugato\Bundle\NuCmsBundle\Entity\File\File;
use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @mixin File
 */
class FileSpec extends ObjectBehavior
{
    function it_should_implement_resource_and_file_interface()
    {
        $this->shouldImplement(ResourceInterface::class);
        $this->shouldImplement(FileInterface::class);
    }
}
