<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse(
        $data = null,
        $message = 'Success',
        $statusCode = 200,
    ): JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $statusCode);
    }


    /**
     * Hatalı JSON cevabı döner
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorResponse(
        string $message = 'Error',
        int    $statusCode = 422
    ): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $statusCode);
    }
}
