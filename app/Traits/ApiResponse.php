<?php

namespace App\Traits;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data = [], $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error($error = [], $message = 'Error', $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $error,
        ], $code);
    }
}
