<?php
namespace App\Exceptions;

use App\Exceptions\Contracts\AppExceptionInterface;
use Exception;
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
        return response()->json([
            'status'  => 'error',
            'message' => $this->getMessage(),
        ], $this->getStatusCode());
    }
}