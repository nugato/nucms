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
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface NavigationInterface extends ResourceInterface, CodeAwareInterface, TimestampableInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return Collection|NavigationItemInterface
     */
    public function getItems(): Collection;

    /**
     * @param NavigationItemInterface $item
     *
     * @return bool
     */
    public function hasItem(NavigationItemInterface $item): bool;

    /**
     * @return bool
     */
    public function hasItems(): bool;

    /**
     * @param NavigationItemInterface $item
     */
    public function addItem(NavigationItemInterface $item): void;

    /**
     * @param NavigationItemInterface $item
     */
    public function removeItem(NavigationItemInterface $item): void;
}
