<?php

namespace Blabs\SalesManago\DataTransferObjects\DataModels;

use Spatie\DataTransferObject\DataTransferObject;

class AddressData extends DataTransferObject
{
    public string $streetAddress;
    public string $zipCode;
    public string $city;
    public string $country;
}
