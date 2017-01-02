<?php

namespace FAPI\Localise\Resource\Api\Import;

use FAPI\Localise\Model\CreatableFromArray;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Imported implements CreatableFromArray
{
    /**
     * @var array
     */
    private $assets;

    /**
     * @var array
     */
    private $locales;

    private function __construct()
    {
    }

    /**
     * @param array $data
     *
     * @return Imported
     */
    public static function createFromArray(array $data)
    {
        $self = new self();

        if (isset($data['assets'])) {
            $self->setAssets($data['assets']);
        }
        if (isset($data['locales'])) {
            $self->setLocales($data['locales']);
        }

        return $self;
    }

    /**
     * @return array
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    /**
     * @param array $assets
     */
    private function setAssets($assets)
    {
        $this->assets = $assets;
    }

    /**
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * @param array $locales
     */
    private function setLocales($locales)
    {
        $this->locales = $locales;
    }
}
