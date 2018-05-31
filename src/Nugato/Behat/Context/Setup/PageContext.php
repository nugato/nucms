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

namespace Nugato\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Nugato\Bundle\NuCmsBundle\Entity\Page;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Factory\Factory;

class PageContext implements Context
{
    /**
     * @var null|Page
     */
    public static $currentPage = null;

    /**
     * @var Factory
     */
    private $pageFactory;

    /**
     * @var EntityRepository
     */
    private $pageRepository;

    /**
     * @param Factory $pageFactory
     * @param EntityRepository $pageRepository
     */
    public function __construct(Factory $pageFactory, EntityRepository $pageRepository)
    {
        $this->pageFactory = $pageFactory;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @Given There are defined page with slug :slug and locale :locale
     *
     * @param string $slug
     * @param string $locale
     */
    public function thereAreDefinedPageWithSlugAndLocale(string $slug, string $locale): void
    {
        /** @var Page $pageEntity */
        $pageEntity = $this->pageFactory->createNew();
        $pageEntity->setCode($slug);
        $pageEntity->setCurrentLocale($locale);
        $pageEntity->setTitle($slug);
        $pageEntity->setSlug($slug);

        $this->pageRepository->add($pageEntity);
        self::$currentPage = $pageEntity;
    }
}
