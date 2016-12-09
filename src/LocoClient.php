<?PHP

/*
 *
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace APIPHP\Localise;

use APIPHP\Localise\Api\Stats;
use APIPHP\Localise\Api\Translation;
use APIPHP\Localise\Api\Tweet;
use Http\Client\Common\HttpMethodsClient;
use APIPHP\Localise\Deserializer\ModelDeserializer;
use APIPHP\Localise\Deserializer\ResponseDeserializer;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class LocoClient
{
    /**
     * @var HttpMethodsClient
     */
    private $httpClient;

    /**
     * @var ResponseDeserializer
     */
    private $deserializer;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @param ResponseDeserializer|null   $deserializer
     * @param HttpClientConfigurator|null $clientConfigurator
     * @param RequestBuilder|null         $requestBuilder
     */
    public function __construct(
        ResponseDeserializer $deserializer = null,
        HttpClientConfigurator $clientConfigurator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $clientConfigurator = $clientConfigurator ?: new HttpClientConfigurator();
        $this->httpClient = $clientConfigurator->createConfiguredClient();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
        $this->deserializer = $deserializer ?: new ModelDeserializer();
    }

    /**
     * @return Api\Translation
     */
    public function translations(): Translation
    {
        return new Api\Translation($this->httpClient, $this->requestBuilder, $this->deserializer);
    }
}
