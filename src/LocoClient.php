<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\Localise;

use FAPI\Localise\Hydrator\Hydrator;
use FAPI\Localise\Hydrator\ModelHydrator;
use Http\Client\HttpClient;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class LocoClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * The constructor accepts already configured HTTP clients.
     * Use the configure method to pass a configuration to the Client and create an HTTP Client.
     */
    public function __construct(
        HttpClient $httpClient,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->httpClient = $httpClient;
        $this->hydrator = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
    }

    public static function configure(
        HttpClientConfigurator $httpClientConfigurator,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ): self {
        $httpClient = $httpClientConfigurator->createConfiguredClient();

        return new self($httpClient, $hydrator, $requestBuilder);
    }

    public function translations(): Api\Translation
    {
        return new Api\Translation($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    public function asset(): Api\Asset
    {
        return new Api\Asset($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    public function import(): Api\Import
    {
        return new Api\Import($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    public function export(): Api\Export
    {
        return new Api\Export($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
