<?php

namespace App\Helpers;

class Response
{
    public function responder(array $data, int $statusCode = 200, string $message = null, array $headers = []): \Illuminate\Http\JsonResponse
    {
        $truthy = $statusCode >= 200 && $statusCode <= 209;
        $isMessageNull = is_null($message);
        if ($isMessageNull && $truthy) {
            $message = 'Action was successful';
        } elseif ($isMessageNull && !$truthy) {
            $message = 'Action was unsuccessful';
        }

        $result = [
            'success' => $truthy ? true : false,
            'data' => $truthy ? $data : [],
            'errors' => !$truthy ? $data : [],
            'message' => $message
        ];
        return response()->json($result, $statusCode, $headers);
    }
}
