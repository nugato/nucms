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

class EditPagePage extends Page implements EditPagePageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/admin/pages/{id}/edit';

    /**
     * @var array
     */
    protected $elements = [
        'Alerts success' => '.t-alert_flashes-success',
    ];

    /**
     * {@inheritdoc}
     */
    public function isAlertsSuccessVisible()
    {
        $this->hasElement('Alerts success');
    }
}
