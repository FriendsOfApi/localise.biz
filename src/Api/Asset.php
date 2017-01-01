<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\Localise\Api;

use FAPI\Localise\Resource\Api\Asset\Asset as AssetModel;
use Psr\Http\Message\ResponseInterface;
use FAPI\Localise\Exception;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Asset extends HttpApi
{
    /**
     * Create an asset.
     * {@link https://localise.biz/api/docs/assets/createasset}
     *
     * @param string $projectKey
     * @param string $id
     *
     * @return AssetModel|ResponseInterface
     *
     * @throws Exception
     */
    public function create(string $projectKey, string $id)
    {
        $param = [
            'name' => $id,
            'id' => $id,
            'type' => 'text',
            'default' => 'untranslated',
        ];

        $response = $this->httpPost(sprintf('/api/assets?key=%s', $projectKey), $param);
        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 201) {
            $this->handleErrors($response);
        }

        if ($response->getStatusCode() === 409) {
            throw Exception\Domain\AssetConflictException::create($id);
        }

        return $this->hydrator->hydrate($response, AssetModel::class);
    }
}
