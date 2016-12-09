<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise\Deserializer;

use Psr\Http\Message\ResponseInterface;

/**
 * Do not serialize at all. Just return a PSR-7 response.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class PSR7Deserializer implements ResponseDeserializer
{
    /**
     * @param ResponseInterface $response
     * @param string            $class
     *
     * @return ResponseInterface
     */
    public function deserialize(ResponseInterface $response, string $class): ResponseInterface
    {
        return $response;
    }
}
