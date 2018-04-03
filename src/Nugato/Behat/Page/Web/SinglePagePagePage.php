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

namespace Nugato\Behat\Page\Web;

use Nugato\Behat\Page\Page;

class SinglePagePagePage extends Page implements SinglePagePageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/{locale}/{slug}';

    /**
     * @var array
     */
    protected $elements = [
        'Title div' => '.t-page_title_div',
    ];

    /**
     * {@inheritdoc}
     */
    public function getTitleText(): string
    {
        return $this->getElement('Title div')->getText();
    }
}
