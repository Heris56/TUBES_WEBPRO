<?php

namespace App\Traits;

trait HttpResponses
{
    public function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Response succesful',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'Error occured',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
