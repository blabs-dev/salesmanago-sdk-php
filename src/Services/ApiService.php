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
        $response_data = json_decode($response->getBody()->getContents(), true);

        $this->checkResponse($response, $apiMethod, $data);

        return new UpsertCustomerResponseData($response_data);
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

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param string                              $apiMethod
     * @param UpsertContactData                   $data
     *
     * @throws InvalidRequestException
     */
    private function checkResponse(\Psr\Http\Message\ResponseInterface $response, string $apiMethod, UpsertContactData $data): void
    {
        if ($response->getStatusCode() !== 200) {
            throw new InvalidRequestException($apiMethod, $data->toArray(), $response);
        }

        $response_data = json_decode($response->getBody(), true);
        if (
            empty($response_data)
            || (
                is_array($response_data) &&
                (
                    !array_key_exists('success', $response_data)
                    || (array_key_exists('success', $response_data) && !$response_data['success'])
                )
            )
        ) {
            throw new InvalidRequestException($apiMethod, $data->toArray(), $response);
        }
    }
}
