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

namespace Nugato\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Nugato\Behat\Page\Admin\Page\CreatePagePage;
use Nugato\Behat\Page\Admin\Page\EditPagePage;
use Nugato\Behat\Page\Admin\Page\IndexPagePage;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class ManagingPagesContext extends RawMinkContext implements Context
{
    /**
     * @var CreatePagePage
     */
    private $createPagePage;

    /**
     * @var IndexPagePage
     */
    private $indexPagePage;

    /**
     * @var EditPagePage
     */
    private $editPagePage;
    /**
     * @var UrlMatcherInterface
     */
    private $urlMatcher;

    /**
     * @param IndexPagePage $indexPagePage
     * @param CreatePagePage $createPagePage
     * @param EditPagePage $editPagePage
     * @param UrlMatcherInterface $urlMatcher
     */
    public function __construct(
        IndexPagePage $indexPagePage,
        CreatePagePage $createPagePage,
        EditPagePage $editPagePage,
        UrlMatcherInterface $urlMatcher
    ) {
        $this->indexPagePage = $indexPagePage;
        $this->createPagePage = $createPagePage;
        $this->editPagePage = $editPagePage;
        $this->urlMatcher = $urlMatcher;
    }

    /**
     * @Given I want to create a page
     */
    public function iWantToCreateAPage()
    {
        $this->createPagePage->open();
    }

    /**
     * @When I specify its title with :title
     *
     * @param string $title
     */
    public function iSpecifyItsTitleWith(string $title): void
    {
        $this->createPagePage->specifyTitle($title, 'en');
    }

    /**
     * @When I specify its content with :content
     *
     * @param string $content
     */
    public function iSpecifyItsContentWith(string $content): void
    {
        $this->createPagePage->specifyContent($content, 'en');
    }

    /**
     * @When I create it
     */
    public function iCreateIt()
    {
        $this->createPagePage->create();
    }

    /**
     * @Then I should be notified that it has been successfully created
     */
    public function iShouldBeNotifiedThatItHasBeenSuccessfullyCreated()
    {
        $currentUrl = parse_url($this->getSession()->getCurrentUrl(), PHP_URL_PATH);
        $routeParams = $this->urlMatcher->match($currentUrl);

        $this->editPagePage->verify(['id' => $routeParams['id']]);
        $this->editPagePage->isAlertsSuccessVisible();
    }
}
