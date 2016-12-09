<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise\Deserializer;

use APIPHP\Localise\Exception\DeserializeException;
use Psr\Http\Message\ResponseInterface;

/**
 * Serialize an HTTP response to array.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class ArrayDeserializer implements ResponseDeserializer
{
    /**
     * @param ResponseInterface $response
     * @param string            $class
     *
     * @return array
     */
    public function deserialize(ResponseInterface $response, string $class): array
    {
        $body = $response->getBody()->__toString();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') !== 0) {
            throw new DeserializeException('The ArrayDeserializer cannot deserialize response with Content-Type:'.$response->getHeaderLine('Content-Type'));
        }

        $content = json_decode($body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new DeserializeException(sprintf('Error (%d) when trying to json_decode response', json_last_error()));
        }

        return $content;
    }
}
