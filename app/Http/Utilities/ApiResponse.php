<?php

namespace App\Http\Utilities;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($message = 'Success', $data, $statusCode = 200, $access_token = null)
    {
        $res = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        if($access_token != null)
            $res['access_token'] = $access_token;

        return new JsonResponse($res, $statusCode);
    }

    public static function error($message = 'Error', $data, $statusCode = 400)
    {
        $err = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];

        return new JsonResponse($err, $statusCode);
    }
}
