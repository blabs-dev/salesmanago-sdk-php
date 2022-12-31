<?php

namespace Blabs\SalesManago\DataTransferObjects\Responses;

class ResponseData extends \Spatie\DataTransferObject\DataTransferObject
{
    public bool $success;
    public array $message;
}