<?php

namespace App\Http\Controllers\Api\Phone;

use App\Models\Api_key;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\PhoneValidationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;

class ApiRequestController extends Controller
{
  use ResponseTrait;

  protected $phoneValidationService;

  public function __construct(PhoneValidationService $phoneValidationService)
  {
    $this->phoneValidationService = $phoneValidationService;
  }

  public function index(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'phone_number' => 'required|string|max:15',
    ]);

    if ($validator->fails()) {
      return $this->errorResponse($validator->errors(), 422, $request->input());
    }

    $apiKey = $request->header('x-api-key');
    $apiData = Api_key::where('key', $apiKey)->first();
    $subscription = Subscription::with('user', 'plan')->where("user_id", $apiData->user_id)->first();

    if (!empty($subscription)) {
      if (!empty($subscription->plan->is_free)) {
        $throttleResponse = $this->applyThrottle($request);
        if ($throttleResponse) {
          return $throttleResponse;
        }
        return $this->freeLookups($request, $subscription);
      } else {
        return $this->paidLookups($request, $subscription);
      }
    } else {
      return $this->errorResponse('No Subscription Found', 404, null);
    }
  }

  public function applyThrottle(Request $request)
  {
    $key = 'api:' . $request->ip() . ':' . $request->header('x-api-key');

    $maxAttempts = 5; // For testing, allow only 2 requests
    $decayMinutes = 1440; // 1440 minutes = 24 hours

    if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
      return $this->errorResponse('Reached daily limit, Please upgrade your plan', 429, null);
    }
    RateLimiter::hit($key, $decayMinutes);
    return null;
  }

  public function paidLookups($request, $subscription)
  {
    if ($subscription->lookups_remaining > 0) {
      $response = $this->getLookups($request->phone_number, $subscription, true);
      $subscription->lookups_remaining -= 1;
      try {
        $subscription->save();
        return $response;
      } catch (\Exception $e) {
        Log::error($e->getMessage());
        return $this->errorResponse('Unable to get the response.', 500, null);
      }
    } else {
      return $this->errorResponse('No lookups remaining.', 403, null);
    }
  }

  public function freeLookups($request, $subscription)
  {
    $response = $this->getLookups($request->phone_number, $subscription)->user_id;
    return $response;
  }

  public function getLookups($phone, $subscription, $isPaid = false)
  {
    $result = $this->phoneValidationService->validatePhone($phone, $subscription->user_id);
    $result = (!empty($result['response_data'])) ? $result['response_data'] : $result;
    dd($result);
    if (isset($result['error']) && $result['error']) {
      return $this->errorResponse('Phone validation failed.', 500, null);
    }

    if ($result['message'] === "Phone is valid.") {

      return response()->json(['status' => 'valid', 'data' => $result], 200);
    } else {
      return response()->json(['status' => 'invalid', 'data' => $result], 422);
    }
  }
}
