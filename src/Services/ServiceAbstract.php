<?php

namespace Blabs\SalesManago\Services;

use Blabs\SalesManago\Client;

abstract class ServiceAbstract
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Replaces elements from passed arrays into the first array recursively.
     *
     * @param array $base         The array in which elements are replaced
     * @param array $replacements The array from which elements will be extracted
     *
     * @return array
     */
    protected static function mergeData(array $base, array $replacements)
    {
        return array_replace_recursive($base, $replacements);
    }
}
