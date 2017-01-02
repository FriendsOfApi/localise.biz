<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\Localise\Api;

use FAPI\Localise\Resource\Api\Import\Imported;
use Psr\Http\Message\ResponseInterface;
use FAPI\Localise\Exception;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Import extends HttpApi
{
    /**
     * Export a locale.
     * {@link https://localise.biz/api/docs/export/exportlocale}.
     *
     * @param string $projectKey
     * @param string $ext
     * @param string $body
     * @param array  $params
     *
     * @return string|ResponseInterface
     *
     * @throws Exception
     */
    public function import(string $projectKey, string $ext, string $body, array $params)
    {
        $params['key'] = $projectKey;
        $response = $this->httpPostRaw(sprintf('/api/import/%s?%s', $ext, http_build_query($params)), $body);

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200 && $response->getStatusCode() !== 201) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Imported::class);
    }
}
