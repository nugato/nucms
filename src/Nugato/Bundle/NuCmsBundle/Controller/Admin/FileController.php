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

namespace Nugato\Bundle\NuCmsBundle\Controller\Admin;

use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FileController extends ResourceController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function bulkDeleteApiAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $this->isGrantedOr403($configuration, ResourceActions::BULK_DELETE);
        $ids = $request->get('ids');
        if (!$ids) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, '\'ids\' params required');
        }

        $this->repository->bulkRemove($ids);

        return $this->viewHandler->handle($configuration, View::create(null, Response::HTTP_NO_CONTENT));
    }
}
