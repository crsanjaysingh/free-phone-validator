<?php

namespace App\Traits;

trait ResponseTrait
{
  public function successResponse($message, $data = [], $statusCode = 200)
  {
    return response()->json([
      'status' => 'success',
      'message' => $message,
      'data' => $data,
    ], $statusCode);
  }

  public function errorResponse($message, $statusCode = 400, $data = [])
  {
    return response()->json([
      'status' => 'error',
      'message' => $message,
      'data' => $data,
    ], $statusCode);
  }
}
