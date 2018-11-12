<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Core\Entity;

use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;

interface ImageAwareInterface
{
    public function setImage(?FileInterface $image): void;

    public function getImage(): ?FileInterface;
}
