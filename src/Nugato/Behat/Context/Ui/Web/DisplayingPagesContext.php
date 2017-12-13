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

namespace Nugato\Behat\Context\Ui\Web;

use Behat\Behat\Context\Context;
use Nugato\Behat\Context\Setup\PageContext;
use Nugato\Behat\Page\Web\SinglePagePage;
use Webmozart\Assert\Assert;

class DisplayingPagesContext implements Context
{
    /**
     * @var SinglePagePage
     */
    private $singlePagePage;

    public function __construct(SinglePagePage $singlePagePage)
    {
        $this->singlePagePage = $singlePagePage;
    }

    /**
     * @When I open this page
     */
    public function iOpenThisPage()
    {
        $page = PageContext::$currentPage;
        $slug = $page->getTranslation()->getLocale() . '/' . $page->getSlug();
        $this->singlePagePage->open(['slug' => $slug]);
    }

    /**
     * @Then I should see the title
     */
    public function iShouldSeeTheTitle()
    {
        Assert::true($this->singlePagePage->isTitleExists());
    }
}
