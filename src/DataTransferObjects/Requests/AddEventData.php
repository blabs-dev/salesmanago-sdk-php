<?php

namespace Blabs\SalesManago\DataTransferObjects\Requests;

use Blabs\SalesManago\DataTransferObjects\DataModels\EventData;
use Spatie\DataTransferObject\DataTransferObject;

class AddEventData extends DataTransferObject
{
    public string $owner;

    public ?string $email;
    public ?string $contactId;

    public EventData $contactEvent;

    public static function fromArray($attributes)
    {
        $hasEmail = array_key_exists('email', $attributes) && !empty($attributes['email']);
        $hasContactId = array_key_exists('contactId', $attributes) && !empty($attributes['contactId']);

        if (!$hasEmail && !$hasContactId)
            throw new \InvalidArgumentException('email or contact id are mandatory fields');

        $data = [
            'owner' => $attributes['owner'],
            'contactEvent' => new EventData($attributes['contactEvent'])
        ];

        if ($hasEmail)
            $data['email'] = $attributes['email'];
        elseif ($hasContactId)
            $data['contactId'] = $attributes['contactId'];

        return new self($data);
    }
}