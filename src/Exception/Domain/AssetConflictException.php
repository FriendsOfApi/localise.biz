<?php

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Localise\Exception\Domain;

use FAPI\Localise\Exception\DomainException;

/**
 *
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class AssetConflictException extends \Exception implements DomainException
{
    public static function create($asset)
    {
        return new self(sprintf('Asset "%s" does already exist', $asset));
    }
}
