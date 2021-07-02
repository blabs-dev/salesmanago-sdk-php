<?php

namespace Blabs\SalesManago;

use Blabs\SalesManago\Services\ContactService;
use GuzzleHttp\Client as HttpClient;

class ServiceFactory
{
    /**
     * Object containing configuration parameters such as api key, secret and client id.
     *
     * @var Config
     */
    protected Config $config;

    /**
     * The Sales Manago Client instance in charge of performing requests to the service.
     *
     * @var Client
     */
    protected Client $client;

    /**
     * An array containing all instanced services.
     *
     * @var array
     */
    protected array $services;

    /**
     * ServiceFactory constructor.
     *
     * @param Config          $config
     * @param HttpClient|null $http_client
     */
    public function __construct(Config $config, HttpClient $http_client = null)
    {
        $this->client = new Client($config, $http_client);
        $this->config = $config;
        $this->services = [];
    }

    /**
     * Creates an instance of the Contact Service.
     *
     * @return mixed
     */
    public function createContactService()
    {
        return $this->createService(ContactService::class);
    }

    /**
     * Creates an instance of the service specified in argument.
     *
     * @param string $className
     *
     * @return mixed
     */
    protected function createService(string $className)
    {
        if (!isset($this->services[$className])) {
            $this->services[$className] = new $className($this->client);
        }

        return $this->services[$className];
    }
}
