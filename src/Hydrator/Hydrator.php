<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Localise\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Hydrate a PSR-7 response to something else.
 */
interface Hydrator
{
    /**
     * @param ResponseInterface $response
     * @param string            $class
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, string $class);
}
