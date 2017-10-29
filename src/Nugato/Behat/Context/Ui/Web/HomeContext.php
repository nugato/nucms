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
use Nugato\Behat\Page\Web\HomePage;
use Webmozart\Assert\Assert;

class HomeContext implements Context
{
    /**
     * @var HomePage
     */
    private $homePage;

    public function __construct(HomePage $homePage)
    {
        $this->homePage = $homePage;
    }
}
