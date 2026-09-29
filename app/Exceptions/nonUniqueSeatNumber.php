<?php

namespace App\Exceptions;

class nonUniqueSeatNumber extends BaseDomainException
{
    protected int $statusCode = 409;
}
