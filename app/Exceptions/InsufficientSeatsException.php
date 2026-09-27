<?php
namespace App\Exceptions;

class InsufficientSeatsException extends BaseDomainException
{
    protected int $statusCode = 422;
}