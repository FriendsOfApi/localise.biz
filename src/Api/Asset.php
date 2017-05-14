<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\Localise\Api;

use FAPI\Localise\Model\Asset\Asset as AssetModel;
use Psr\Http\Message\ResponseInterface;
use FAPI\Localise\Exception;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Asset extends HttpApi
{
    /**
     * Create an asset.
     * {@link https://localise.biz/api/docs/assets/createasset}.
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

    /**
     * Patch an asset.
     * {@link https://localise.biz/api/docs/assets/patchasset}.
     *
     * @param string $projectKey
     * @param string $id
     * @param string $type
     * @param string $name
     * @param string $context
     * @param string $notes
     *
     * @return AssetModel|ResponseInterface
     *
     * @throws Exception
     */
    public function patch(string $projectKey, string $id, $type = null, $name = null, $context = null, $notes = null)
    {
        $param = [
            'id' => $id,
        ];

        if ($type) {
            $param['type'] = $type;
        }
        if ($name) {
            $param['name'] = $name;
        }
        if ($context) {
            $param['context'] = $context;
        }
        if ($notes) {
            $param['notes'] = $notes;
        }

        $response = $this->httpPatch(sprintf('/api/assets/%s.json?key=%s', $id, $projectKey), $param);
        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() === 409) {
            throw Exception\Domain\AssetConflictException::create($id);
        }

        if ($response->getStatusCode() >= 400) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, AssetModel::class);
    }
}
