<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse($data = null, $message = null, $code = Response::HTTP_OK)
    {
        return $message ?
            response()->json(['data' => $data, 'message' => $message], $code)
            : response()->json(['data' => $data], $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}
