<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Core\Entity;

use Nugato\Bundle\NuCmsBundle\Entity\File\FileInterface;

trait ImageAwareTrait
{
    /**
     * @var FileInterface|null
     */
    protected $image;

    public function setImage(?FileInterface $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?FileInterface
    {
        return $this->image;
    }
}
