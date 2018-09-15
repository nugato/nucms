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

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Repository;

use Doctrine\ORM\NoResultException;
use Nugato\Bundle\NuCmsBundle\Repository\TranslatableEntityRepository;

class SettingsRepository extends TranslatableEntityRepository implements SettingsRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findAllByLocale(string $locale): array
    {
        $queryBuilder = $this->createListQueryBuilder($locale);

        try {
            return $queryBuilder->getQuery()->getResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }
}
