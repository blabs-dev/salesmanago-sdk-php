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
    public function __construct(string $clientId, string $apiSecret, string $apiKey = null)
    {
        $this->clientId = $clientId;
        $this->apiSecret = $apiSecret;
        $this->apiKey = $apiKey ?? $this->generateRandomString();
    }

    private function generateRandomString($length = 10): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
