<?php
namespace App\Exceptions;

class InactiveEntityException extends BaseDomainException
{
    protected int $statusCode = 422;
}