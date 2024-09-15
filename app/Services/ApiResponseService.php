<?php

namespace App\Services;

use App\Models\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ApiResponseService
{
  public function storeResponse($lookupType, $lookupFor, $result)
  {
    $userId = Auth::check() ? Auth::user()->id : null;
    $apiResponse = new ApiResponse();
    $apiResponse->lookup_type = $lookupType;
    $apiResponse->lookup_for = $lookupFor;
    $apiResponse->fraud_score = $result['fraud_score'];
    $apiResponse->status = $result['valid'];
    $apiResponse->country = $result['country'];
    $apiResponse->user_id = $userId;
    $apiResponse->response_data = json_encode($result);
    $apiResponse->save();
  }
}
