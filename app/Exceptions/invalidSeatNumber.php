<?php

namespace App\Exceptions;

class invalidSeatNumber extends BaseDomainException
{
    protected int $statusCode = 422;
}
