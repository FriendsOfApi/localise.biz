<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Localise;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\UriFactory;

/**
 * Configure an HTTP client.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 *
 * @internal this class should not be used outside of the API Client, it is not part of the BC promise
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
     * @var Plugin[]
     */
    private $prependPlugins = [];

    /**
     * @var Plugin[]
     */
    private $appendPlugins = [];

    public function __construct(HttpClient $httpClient = null, UriFactory $uriFactory = null)
    {
        $this->httpClient = $httpClient ?? HttpClientDiscovery::find();
        $this->uriFactory = $uriFactory ?? UriFactoryDiscovery::find();
    }

    public function createConfiguredClient(): HttpClient
    {
        $plugins = $this->prependPlugins;

        $plugins[] = new Plugin\AddHostPlugin($this->uriFactory->createUri($this->endpoint));
        $plugins[] = new Plugin\HeaderDefaultsPlugin([
            'User-Agent' => 'FriendsOfApi/Localise (https://github.com/FriendsOfApi/Localise)',
        ]);

        return new PluginClient($this->httpClient, array_merge($plugins, $this->appendPlugins));
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function appendPlugin(Plugin ...$plugin): self
    {
        foreach ($plugin as $p) {
            $this->appendPlugins[] = $p;
        }

        return $this;
    }

    public function prependPlugin(Plugin ...$plugin): self
    {
        $plugin = array_reverse($plugin);
        foreach ($plugin as $p) {
            array_unshift($this->prependPlugins, $p);
        }

        return $this;
    }
}
