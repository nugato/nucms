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

namespace Nugato\Bundle\NuCmsBundle\Entity\Navigation;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface NavigationItemInterface extends ResourceInterface
{
    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * {@inheritdoc}
     */
    public function setNavigation(NavigationInterface $navigation): void;

    /**
     * {@inheritdoc}
     */
    public function getNavigation(): ?NavigationInterface;

    /**
     * @return NavigationItemInterface|null
     */
    public function getRoot(): ?self;

    /**
     * @param NavigationItemInterface|null $parent
     */
    public function setParent(?NavigationItemInterface $parent): void;

    /**
     * @return NavigationItemInterface|null
     */
    public function getParent(): ?self;

    /**
     * @return Collection|NavigationItemInterface[]
     */
    public function getChildren(): Collection;
}
