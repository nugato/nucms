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

namespace Nugato\Bundle\NuCmsBundle\Repository\File;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class FileRepository extends EntityRepository implements FileRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function bulkRemove(array $ids): void
    {
        foreach ($ids as $id) {
            $file = $this->find((int)$id);
            if (null !== $file) {
                $this->_em->remove($file);
            }
        }

        $this->_em->flush();
    }
}
