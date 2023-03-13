<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\Localise\Api;

use FAPI\Localise\Exception;
use FAPI\Localise\Model\Asset\Asset as AssetModel;
use FAPI\Localise\Model\Asset\TagDeleted;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Asset extends HttpApi
{
    /**
     * Get an asset.
     * {@link https://localise.biz/api/docs/assets/getasset}.
     */
    public function get(string $projectKey, string $id): AssetModel
    {
        $response = $this->httpGet(sprintf('/api/assets/%s.json?key=%s', $id, $projectKey));

        return $this->hydrator->hydrate($response, AssetModel::class);
    }

    /**
     * Create an asset.
     * {@link https://localise.biz/api/docs/assets/createasset}.
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

        if (409 === $response->getStatusCode()) {
            throw Exception\Domain\AssetConflictException::create($id);
        }

        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, AssetModel::class);
    }

    /**
     * Tag an asset.
     * {@link https://localise.biz/api/docs/assets/tagasset}.
     *
     * @return AssetModel|ResponseInterface
     *
     * @throws Exception\DomainException
     */
    public function tag(string $projectKey, string $id, string $tag)
    {
        $param = [
            'name' => $tag,
        ];

        $response = $this->httpPost(sprintf('/api/assets/%s/tags?key=%s', $id, $projectKey), $param);
        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() >= 400) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, AssetModel::class);
    }

    /**
     * Patch an asset.
     * {@link https://localise.biz/api/docs/assets/patchasset}.
     *
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

        if (409 === $response->getStatusCode()) {
            throw Exception\Domain\AssetConflictException::create($id);
        }

        if ($response->getStatusCode() >= 400) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, AssetModel::class);
    }

    /**
     * Delete a tag.
     * {@link https://localise.biz/api/docs/assets/untagasset}.
     */
    public function deleteTag(string $projectKey, string $assetId, string $tag): TagDeleted
    {
        $response = $this->httpDelete(sprintf('/api/assets/%s/tags/%s.json?key=%s', $assetId, $tag, $projectKey));

        return $this->hydrator->hydrate($response, TagDeleted::class);
    }
}
