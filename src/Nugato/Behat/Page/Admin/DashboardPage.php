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

namespace Nugato\Behat\Page\Admin;

use Nugato\Behat\Page\Page;

class DashboardPage extends Page implements DashboardPageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/admin/';

    /**
     * @var array
     */
    protected $elements = [
        'Logout button' => '.t-logout_button',
    ];

    /**
     * Click the logout button
     */
    public function logOut(): void
    {
        $this->getElement('Logout button')->press();
    }
}
