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

class CreatePagePage extends Page implements CreatePagePageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/admin/pages/new';

    /**
     * @var array
     */
    protected $elements = [
        'Create button' => '.t-create_submit_button',
        'Title input file - en' => '#nucms_page_translations_en_title',
        'Title input file - pl' => '#nucms_page_translations_pl_title',
        'Content input file - en' => '#nucms_page_translations_en_content',
        'Content input file - pl' => '#nucms_page_translations_pl_content',
    ];

    /**
     * {@inheritdoc}
     */
    public function specifyTitle(string $title, string $locale): void
    {
        $this->getElement('Title input file - ' . $locale)->setValue($title);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyContent(string $content, string $locale): void
    {
        $this->getElement('Content input file - ' . $locale)->setValue($content);
    }

    /**
     * {@inheritdoc}
     */
    public function create(): void
    {
        $this->getElement('Create button')->press();
    }
}
