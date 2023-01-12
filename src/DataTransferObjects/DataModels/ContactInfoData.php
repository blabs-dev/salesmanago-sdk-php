<?php

namespace Blabs\SalesManago\DataTransferObjects\DataModels;

use Spatie\DataTransferObject\DataTransferObject;

class ContactInfoData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $phone;
    public $fax;
    public int $score;
    public string $state;
    public bool $optedOut;
    public bool $optedOutPhone;
    public bool $deleted;
    public bool $invalid;
    public $company;
    public string $externalId;
    public $address;
    public string $contactId;
    public string $birthdayYear;
    public string $birthdayMonth;
    public string $birthdayDay;
    public int $modifiedOn;
    public int $createdOn;
    public $lastVisit;
}
