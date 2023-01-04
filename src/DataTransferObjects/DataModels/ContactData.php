<?php

namespace Blabs\SalesManago\DataTransferObjects\DataModels;

use Spatie\DataTransferObject\DataTransferObject;

class ContactData extends DataTransferObject
{
    public string $email;
    public string $phone;
    public string $name;

    public ?string $externalId;
    public ?AddressData $address;

    public static function fromArray($attributes): self
    {
        $data = [
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
            'name'  => $attributes['name'],
        ];

        if (array_key_exists('externalId', $attributes)) {
            $data['externalId'] = $attributes['externalId'];
        }

        if (array_key_exists('address', $attributes)) {
            $data['address'] = new AddressData($attributes['address']);
        }

        return new self($data);
    }
}
