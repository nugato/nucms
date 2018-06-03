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

namespace Nugato\Bundle\NuCmsBundle\Pagination\Template;

use Pagerfanta\View\Template\Template;

class UiKitTemplate extends Template
{
    static protected $defaultOptions = array();

    /**
     * {@inheritdoc}
     */
    public function container()
    {
        return '<ul class="uk-pagination" uk-margin>%pages%</ul>';
    }

    /**
     * {@inheritdoc}
     */
    public function page($page)
    {
        $text = $page;

        return $this->pageWithText($page, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function pageWithText($page, $text)
    {
        return '<li><a href="' . $this->generateRoute($page) . '">' . $text . '</a></li>';
    }

    /**
     * {@inheritdoc}
     */
    public function previousDisabled()
    {
        return '<li><a href="#"><span uk-pagination-previous></span></a></li>';
    }

    /**
     * {@inheritdoc}
     */
    public function previousEnabled($page)
    {
        return '<li><a href="' . $this->generateRoute($page) . '"><span uk-pagination-previous></span></a></li>';
    }

    /**
     * {@inheritdoc}
     */
    public function nextDisabled()
    {
        return '<li><a href="#"><span uk-pagination-next></span></a></li>';
    }

    /**
     * {@inheritdoc}
     */
    public function nextEnabled($page)
    {
        return '<li><a href="' . $this->generateRoute($page) . '"><span uk-pagination-next></span></a></li>';
    }

    /**
     * {@inheritdoc}
     */
    public function first()
    {
        return $this->page(1);
    }

    /**
     * {@inheritdoc}
     */
    public function last($page)
    {
        return $this->page($page);
    }

    /**
     * {@inheritdoc}
     */
    public function current($page)
    {
        return '<li class="uk-active"><span>' . $page . '</span></li>';
    }

    /**
     * {@inheritdoc}
     */
    public function separator()
    {
        return '<li class="uk-disabled"><span>...</span></li>';
    }
}
