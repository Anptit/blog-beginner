<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait responseStatus
{
    public function successResponse($data)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], Response::HTTP_OK);
    }
}