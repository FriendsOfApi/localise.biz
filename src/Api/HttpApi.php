<?php

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise\Api;

use Http\Client\HttpClient;
use APIPHP\Localise\Deserializer\ResponseDeserializer;
use APIPHP\Localise\RequestBuilder;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class HttpApi
{
    /**
     * The HTTP client.
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var ResponseDeserializer
     */
    protected $serializer;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @param HttpClient           $httpClient
     * @param RequestBuilder       $requestBuilder
     * @param ResponseDeserializer $deserializer
     */
    public function __construct(HttpClient $httpClient, RequestBuilder $requestBuilder, ResponseDeserializer $deserializer)
    {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
        $this->deserializer = $deserializer;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     GET parameters.
     * @param array  $requestHeaders Request Headers.
     *
     * @return ResponseInterface
     */
    protected function httpGet($path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        if (count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('GET', $path, $requestHeaders)
        );
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return ResponseInterface
     */
    protected function httpPost($path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
        return $this->httpPostRaw($path, http_build_query($parameters), $requestHeaders);
    }

    /**
     * Send a POST request with raw data.
     *
     * @param string       $path           Request path.
     * @param array|string $body           Request body.
     * @param array        $requestHeaders Request headers.
     *
     * @return ResponseInterface
     */
    protected function httpPostRaw($path, $body, array $requestHeaders = []): ResponseInterface
    {
        return $response = $this->httpClient->sendRequest(
            $this->requestBuilder->create('POST', $path, $requestHeaders, $body)
        );
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return ResponseInterface
     */
    protected function httpPut($path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('PUT', $path, $requestHeaders, http_build_query($parameters))
        );
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return ResponseInterface
     */
    protected function httpDelete($path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        $requestHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
        return $this->httpClient->sendRequest(
            $this->requestBuilder->create('DELETE', $path, $requestHeaders, http_build_query($parameters))
        );
    }
}
