<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\Localise\Api;

use FAPI\Localise\Model\Translation\TranslationDeleted;
use FAPI\Localise\Model\Translation\Translation as TranslationModel;
use Psr\Http\Message\ResponseInterface;
use FAPI\Localise\Exception;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Translation extends HttpApi
{
    /**
     * Get a translation.
     * {@link https://localise.biz/api/docs/translations/gettranslation}.
     *
     * @param string $projectKey
     * @param string $id
     * @param string $locale
     *
     * @return TranslationModel|ResponseInterface
     *
     * @throws Exception
     */
    public function get(string $projectKey, string $id, string $locale)
    {
        $response = $this->httpGet(sprintf('/api/translations/%s/%s?key=%s', rawurlencode($id), $locale, $projectKey));

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TranslationModel::class);
    }

    /**
     * Create a new translation.
     * {@link https://localise.biz/api/docs/translations/translate}.
     *
     * @param string $projectKey
     * @param string $id
     * @param string $locale
     * @param string $translation
     *
     * @return TranslationModel|ResponseInterface
     *
     * @throws Exception
     */
    public function create(string $projectKey, string $id, string $locale, string $translation = null)
    {
        $response = $this->httpPostRaw(sprintf('/api/translations/%s/%s?key=%s', rawurlencode($id), $locale, $projectKey), $translation);
        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() >= 400) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TranslationModel::class);
    }

    /**
     * Delete translation
     * {@link https://localise.biz/api/docs/translations/untranslate}.
     *
     * @param string $projectKey
     * @param string $id
     * @param string $locale
     *
     * @return TranslationDeleted|ResponseInterface
     *
     * @throws Exception
     */
    public function delete(string $projectKey, string $id, string $locale)
    {
        $response = $this->httpDelete(sprintf('/api/translations/%s/%s?key=%s', rawurlencode($id), $locale, $projectKey));
        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TranslationDeleted::class);
    }
}
