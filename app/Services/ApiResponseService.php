<?php

namespace App\Services;

use App\Models\ApiResponse;
use App\Models\Lookup_history;
use Illuminate\Support\Facades\Auth;

class ApiResponseService
{
  public function storeResponse($lookupType, $lookupFor, $result)
  {
    if (is_string($result)) {
      $result = json_decode($result, true);
    }
    $userId = Auth::check() ? Auth::user()->id : null;
    $apiResponse = new ApiResponse();
    $apiResponse->lookup_type = $lookupType;
    $apiResponse->lookup_for = $lookupFor;
    $apiResponse->fraud_score = $result['fraud_score'] ?? 0;
    $apiResponse->status = $result['valid'];
    $apiResponse->country = $result['country'];
    $apiResponse->user_id = $userId;
    $apiResponse->response_data = json_encode($result);
    $apiResponse->save();
  }
  public function getResponse($lookup_type = 'phone', $lookup_for)
  {
    return $apiResponse = ApiResponse::where("lookup_type", $lookup_type)
      ->where("lookup_for", $lookup_for)
      ->where('created_at', '>=', now()->subDays(30))
      ->first();
  }

  public function updateLookupHistory($lookupType, $lookupFor, $result, $userId)
  {
    if (is_string($result)) {
      $result = json_decode($result, true);
    }
    $userId = $userId ?? (Auth::check() ? Auth::user()->id : null);
    $lookup_history = new Lookup_history();
    $lookup_history->lookup_type = $lookupType;
    $lookup_history->lookup_for = $lookupFor;
    $lookup_history->fraud_score = $result['fraud_score'] ?? 0;
    $lookup_history->status = $result['valid'];
    $lookup_history->country = $result['country'];
    $lookup_history->user_id = $userId;
    $lookup_history->response_data = json_encode($result);
    $lookup_history->save();
  }
}
