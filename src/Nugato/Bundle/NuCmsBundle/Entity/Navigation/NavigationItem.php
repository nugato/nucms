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
use Sylius\Component\Resource\Model\TranslatableTrait;

class NavigationItem implements NavigationItemInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var NavigationInterface
     */
    protected $navigation;

    /**
     * @var int
     */
    protected $left;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var int
     */
    protected $right;

    /**
     * @return NavigationItemInterface|null
     */
    protected $root;

    /**
     * @return NavigationItemInterface|null
     */
    protected $parent;

    /**
     * @var Collection|NavigationItemInterface[]
     */
    protected $children;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl(string $url): void
    {
        $this->getTranslation()->setUrl($url);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl(): string
    {
        return $this->getTranslation()->getUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function setNavigation(NavigationInterface $navigation): void
    {
        $this->navigation = $navigation;
    }

    /**
     * {@inheritdoc}
     */
    public function getNavigation(): ?NavigationInterface
    {
        return $this->navigation;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoot(): ?NavigationItemInterface
    {
        return $this->root;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(?NavigationItemInterface $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?NavigationItemInterface
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): NavigationItemTranslationInterface
    {
        return new NavigationItemTranslation();
    }
}
