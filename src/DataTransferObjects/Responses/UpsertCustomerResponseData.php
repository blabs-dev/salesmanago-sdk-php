<?php

namespace Blabs\SalesManago\DataTransferObjects\Responses;

class UpsertCustomerResponseData extends ResponseData
{
    public string $contactId;
    public ?string $externalId;
}
