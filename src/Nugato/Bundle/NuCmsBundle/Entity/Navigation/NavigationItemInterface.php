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
use Sylius\Component\Resource\Model\TranslatableInterface;

interface NavigationItemInterface extends ResourceInterface, TranslatableInterface
{
    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * @return string|null
     */
    public function getUrl(): ?string;

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

    /**
     * @return bool
     */
    public function hasChildren(): bool;

    /**
     * @param NavigationItemInterface $navigationItem
     *
     * @return bool
     */
    public function hasChild(NavigationItemInterface $navigationItem): bool;

    /**
     * @param NavigationItemInterface $navigationItem
     */
    public function addChild(NavigationItemInterface $navigationItem): void;

    /**
     * @param NavigationItemInterface $navigationItem
     */
    public function removeChild(NavigationItemInterface $navigationItem): void;
}
