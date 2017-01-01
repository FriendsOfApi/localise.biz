<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Localise\Model;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
interface CreatableFromArray
{
    /**
     * Create an API response object from the HTTP response from the API server.
     *
     * @param array $data
     *
     * @return self
     */
    public static function createFromArray(array $data);
}
