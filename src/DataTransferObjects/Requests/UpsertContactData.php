<?php

namespace Blabs\SalesManago\DataTransferObjects\Requests;

use Blabs\SalesManago\DataTransferObjects\DataModels\ContactData;

class UpsertContactData extends \Spatie\DataTransferObject\DataTransferObject
{
    public string $owner;

    public ContactData $contact;

    public ?string $province;
    public ?string $birthday;

    public bool $forceOptIn = true;
    public bool $forceOptOut = false;
    public bool $forcePhoneOptIn = true;
    public bool $forcePhoneOptOut = false;

    public ?array $tags;
    public ?array $properties;

    public static function fromArray($attributes)
    {
        $data = [
            'owner'   => $attributes['owner'],
            'contact' => new ContactData($attributes['contact']),
        ];

        if (array_key_exists('province', $attributes)) {
            $data['province'] = $attributes['province'];
        }

        if (array_key_exists('birthday', $attributes)) {
            $data['birthday'] = $attributes['birthday'];
        }

        if (array_key_exists('forceOptIn', $attributes)) {
            $data['forceOptIn'] = $attributes['forceOptIn'];
        }

        if (array_key_exists('forceOptOut', $attributes)) {
            $data['forceOptOut'] = $attributes['forceOptOut'];
        }

        if (array_key_exists('forceOptIn', $attributes)) {
            $data['forceOptIn'] = $attributes['forceOptIn'];
        }

        if (array_key_exists('forcePhoneOptIn', $attributes)) {
            $data['forcePhoneOptIn'] = $attributes['forcePhoneOptIn'];
        }

        if (array_key_exists('forcePhoneOptOut', $attributes)) {
            $data['forcePhoneOptOut'] = $attributes['forcePhoneOptOut'];
        }

        if (array_key_exists('tags', $attributes)) {
            $data['tags'] = $attributes['tags'];
        }

        if (array_key_exists('properties', $attributes)) {
            $data['properties'] = $attributes['properties'];
        }

        return new self($data);
    }
}
