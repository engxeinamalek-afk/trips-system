<?php
namespace App\Exceptions;

use App\Exceptions\Contracts\AppExceptionInterface;
use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

abstract class BaseDomainException extends Exception
{
    protected int $statusCode = 422;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function render(): JsonResponse
    {
        return ApiResponse::error(
            error: [
                'domain' => [$this->getMessage()] 
            ],
            message: $this->getMessage(), 
            code: $this->getStatusCode() 
        );
    }
}