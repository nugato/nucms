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

namespace Nugato\Behat\Page\Admin\Page;

use Nugato\Behat\Page\Page;

class IndexPagePage extends Page implements IndexPagePageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/admin/pages';

    /**
     * @var array
     */
    protected $elements = [];
}
