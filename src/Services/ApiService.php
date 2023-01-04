<?php

namespace Blabs\SalesManago\Services;

use Blabs\SalesManago\DataTransferObjects\Requests\AddEventData;
use Blabs\SalesManago\DataTransferObjects\Requests\UpsertContactData;
use Blabs\SalesManago\DataTransferObjects\Responses\AddEventResponseData;
use Blabs\SalesManago\DataTransferObjects\Responses\UpsertCustomerResponseData;
use Blabs\SalesManago\Exceptions\InvalidRequestException;

class ApiService extends ServiceAbstract
{
    public function upsertContact(array $attributes): UpsertCustomerResponseData
    {
        if (!array_key_exists('owner', $attributes)) {
            throw new \InvalidArgumentException('owner is a mandatory field');
        }

        $apiMethod = '/contact/upsert';
        $data = UpsertContactData::fromArray($attributes);

        $response = $this->client->doRequest($apiMethod, $data->toArray());
        if ($response->getStatusCode() !== 200) {
            throw new InvalidRequestException($apiMethod, $data->toArray(), $response);
        }

        return new UpsertCustomerResponseData(json_decode($response->getBody(), true));
    }

    public function addExternalEvent(array $attributes): AddEventResponseData
    {
        if (!array_key_exists('owner', $attributes)) {
            throw new \InvalidArgumentException('owner is a mandatory field');
        }

        $apiMethod = '/contact/addContactExtEvent';
        $data = AddEventData::fromArray($attributes);

        $response = $this->client->doRequest($apiMethod, $data->toArray());
        if ($response->getStatusCode() !== 200) {
            throw new InvalidRequestException($apiMethod, $data->toArray(), $response);
        }

        return new AddEventResponseData(json_decode($response->getBody(), true));
    }
}
