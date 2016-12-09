<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise\Api;

use APIPHP\Localise\Resource\Api\Translation\CreateResponse;
use APIPHP\Localise\Resource\Api\Translation\DeleteResponse;
use APIPHP\Localise\Resource\Api\Translation\ShowResponse;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Translation extends HttpApi
{
    /**
     * @param string $projectKey
     * @param string $id
     * @param string $locale
     *
     * @return ShowResponse
     */
    public function show(string $projectKey, string $id, string $locale)
    {
        Assert::notEmpty($projectKey);
        Assert::notEmpty($id);
        Assert::notEmpty($locale);

        $response = $this->httpGet(sprintf('/api/translations/%s/%s?key=%s', $id, $locale, $projectKey));

        // TODO handle non 200 responses

        return $this->deserializer->deserialize($response, ShowResponse::class);
    }

    /**
     * @param array $params
     *
     * @return CreateResponse
     */
    public function create(string $projectKey, string $id, string $locale)
    {
        Assert::notEmpty($projectKey);
        Assert::notEmpty($id);
        Assert::notEmpty($locale);

        $response = $this->httpPost(sprintf('/api/translations/%s/%s?key=%s', $id, $locale, $projectKey));

        // TODO handle non 200 responses
        return $this->deserializer->deserialize($response, CreateResponse::class);
    }

    /**
     * @param array $params
     *
     * @return DeleteResponse
     */
    public function delete(string $projectKey, string $id, string $locale)
    {
        Assert::notEmpty($projectKey);
        Assert::notEmpty($id);
        Assert::notEmpty($locale);

        $response = $this->httpDelete(sprintf('/api/translations/%s/%s?key=%s', $id, $locale, $projectKey));

        // TODO handle non 200 responses

        return $this->deserializer->deserialize($response, DeleteResponse::class);
    }
}
