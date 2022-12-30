<?php

namespace Blabs\SalesManago;

class Configurator
{
    private string $clientId;

    private string $apiKey;

    private string $apiSecret;

    /**
     * Config constructor.
     *
     * @param string $clientId
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $clientId, string $apiKey, string $apiSecret)
    {
        $this->clientId = $clientId;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * @param string $clientId
     *
     * @return Configurator
     */
    public function setClientId(string $clientId): Configurator
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @param string $apiKey
     *
     * @return Configurator
     */
    public function setApiKey(string $apiKey): Configurator
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $apiSecret
     *
     * @return Configurator
     */
    public function setApiSecret(string $apiSecret): Configurator
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    /**
     * @return string
     */
    public function getSha(): string
    {
        return sha1($this->apiKey.$this->clientId.$this->apiSecret);
    }
}