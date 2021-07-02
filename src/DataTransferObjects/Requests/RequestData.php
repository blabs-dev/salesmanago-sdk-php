<?php


namespace Blabs\SalesManago\DataTransferObjects\Requests;


use JsonSerializable;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class RequestData extends FlexibleDataTransferObject implements JsonSerializable
{
    public string $clientId;

    public string $apiKey;

    public string $requestTime;

    public string $sha;

    public function jsonSerialize()
    {
        return json_encode($this->toArray());
    }
}