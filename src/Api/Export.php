<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\Localise\Api;

use FAPI\Localise\Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Export extends HttpApi
{
    /**
     * Export a locale.
     * {@link https://localise.biz/api/docs/export/exportlocale}.
     *
     * @return string|ResponseInterface
     *
     * @throws Exception
     */
    public function locale(string $projectKey, string $locale, string $ext, array $params)
    {
        $params['key'] = $projectKey;
        $response = $this->httpGet(sprintf('/api/export/locale/%s.%s?%s', $locale, $ext, http_build_query($params)));

        if (!$this->hydrator) {
            return $response;
        }

        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return (string) $response->getBody();
    }
}
