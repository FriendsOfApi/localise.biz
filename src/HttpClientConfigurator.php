<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise;

use Http\Client\HttpClient;
use Http\Client\Common\PluginClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\UriFactory;
use Http\Client\Common\Plugin;

/**
 * Configure a HTTP client.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class HttpClientConfigurator
{
    /**
     * @var string
     */
    private $endpoint = 'https://localise.biz';

    /**
     * @var UriFactory
     */
    private $uriFactory;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @return PluginClient
     */
    public function createConfiguredClient()
    {
        $plugins = [
            new Plugin\AddHostPlugin($this->getUriFactory()->createUri($this->getEndpoint())),
            new Plugin\HeaderDefaultsPlugin([
                'User-Agent' => 'api-php/localise.biz (https://github.com/api-php/localise.biz)',
            ]),
        ];

        return new PluginClient($this->getHttpClient(), $plugins);
    }

    /**
     * @return string
     */
    private function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return HttpClientConfigurator
     */
    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return UriFactory
     */
    private function getUriFactory(): UriFactory
    {
        if ($this->uriFactory === null) {
            $this->uriFactory = UriFactoryDiscovery::find();
        }

        return $this->uriFactory;
    }

    /**
     * @param UriFactory $uriFactory
     *
     * @return HttpClientConfigurator
     */
    public function setUriFactory(UriFactory $uriFactory)
    {
        $this->uriFactory = $uriFactory;

        return $this;
    }

    /**
     * @return HttpClient
     */
    private function getHttpClient(): HttpClient
    {
        if ($this->httpClient === null) {
            $this->httpClient = HttpClientDiscovery::find();
        }

        return $this->httpClient;
    }

    /**
     * @param HttpClient $httpClient
     *
     * @return HttpClientConfigurator
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
