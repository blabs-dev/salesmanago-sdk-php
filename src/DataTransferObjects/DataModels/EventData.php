<?php

namespace Blabs\SalesManago\DataTransferObjects\DataModels;

use Spatie\DataTransferObject\DataTransferObject;

class EventData extends DataTransferObject
{
    public int $date;
    public string $contactExtEventType;

    public ?string $description;
    public ?string $products;
    public ?string $location;
    public ?float $value;
    public ?string $detail1;
    public ?string $detail2;
    public ?string $detail3;
    public ?string $externalId;
    public ?string $shopDomain;
}