<?php

namespace App\Exceptions;

class InvalidBookingStatusException extends BaseDomainException
{
    protected int $statusCode = 422;
}
