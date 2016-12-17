<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise\Api;

use APIPHP\Localise\Resource\Api\Asset\CreateResponse;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Asset extends HttpApi
{
    /**
     * @param string $projectKey
     * @param string $id
     * @param string $locale
     * @param string $translation
     *
     * @return CreateResponse
     */
    public function create(string $projectKey, string $id)
    {
        Assert::notEmpty($projectKey);
        Assert::notEmpty($id);

        $param = [
            'name' => $id,
            'id' => $id,
            'type' => 'text',
            'default' => 'untranslated',
        ];

        $response = $this->httpPost(sprintf('/api/assets?key=%s', $projectKey), $param);

        // TODO handle non 201 responses
        // TODO handle 409 response
        return $this->deserializer->deserialize($response, CreateResponse::class);
    }
}
