<?php

namespace Blabs\SalesManago;

use Blabs\SalesManago\DataTransferObjects\Requests\RequestData;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const API_BASE_URI = 'https://app2.salesmanago.pl/api';

    /**
     * Object containing configuration parameters such as api key, secret and client id.
     *
     * @var Configurator
     */
    private Configurator $config;

    /**
     * The GuzzleHttp\Client instance used to perform http requests.
     *
     * @var HttpClient
     */
    private HttpClient $httpClient;

    /**
     * Client constructor.
     *
     * @param Configurator    $config
     * @param HttpClient|null $httpClient
     */
    public function __construct(Configurator $config, HttpClient $httpClient = null)
    {
        $this->config = $config;
        $this->httpClient = $httpClient ?? new HttpClient([
            //'base_uri' => self::API_BASE_URI,
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Performs actual http request to the API service.
     *
     * @param string      $apiMethod
     * @param RequestData $data
     *
     * @return ResponseInterface
     */
    public function doRequest(string $apiMethod, array $data): ResponseInterface
    {
        $data = $this->mergeData($this->createAuthData(), $data);

        try {
            $response = $this->httpClient->post($this->buildUrl($apiMethod), ['json' => $data]);
        } catch (GuzzleException $exception) {
            $this->handleHttpException($exception);
        }

        return $response;
    }

    /**
     * Handles an exception generated by the HTTP client
     * (i.e. error responses from server, connection issues).
     *
     * @param GuzzleException $exception
     */
    private function handleHttpException(GuzzleException $exception)
    {
        // TODO: handling http exception
    }

    /**
     * Creates authentication parameters from config object.
     *
     * @return array
     */
    public function createAuthData(): array
    {
        return [
            'clientId'    => $this->config->getClientId(),
            'apiKey'      => $this->config->getApiKey(),
            'requestTime' => time(),
            'sha'         => $this->config->getSha(),
        ];
    }

    private function mergeData(array $base, array $replacements): array
    {
        return array_filter(
            array_merge($base, $replacements),
            function ($value) {
                return $value !== null;
            }
        );
    }

    /**
     * @param string $apiMethod
     *
     * @return string
     */
    private function buildUrl(string $apiMethod): string
    {
        return self::API_BASE_URI.$apiMethod;
    }
}
