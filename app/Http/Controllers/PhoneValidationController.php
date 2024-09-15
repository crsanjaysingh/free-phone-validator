<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhoneValidationService;
use App\Services\ApiResponseService;


class PhoneValidationController extends Controller
{

  protected $phoneValidationService;
  protected $apiResponseService;

  public function __construct(PhoneValidationService $phoneValidationService, ApiResponseService $apiResponseService)
  {
    $this->phoneValidationService = $phoneValidationService;
    $this->apiResponseService = $apiResponseService;
  }

  public function validatePhone(Request $request)
  {
    $request->validate([
      'phone' => 'required|string|max:15',
    ]);

    $phone = $request->phone;
    $result = $this->phoneValidationService->validatePhone($phone);

    if (isset($result['error']) && $result['error']) {
      return response()->json(
        data: [
          'message' => 'Phone validation failed.',
          'error' => $result['message'],
        ],
        status: 500
      );
    }

    $this->apiResponseService->storeResponse('phone', $request->phone, $result);

    if ($result['message'] === "Phone is valid.") {
      return response()->json(['status' => 'valid', 'data' => $result], 200);
    } else {
      return response()->json(['status' => 'invalid', 'data' => $result], 422);
    }
  }
}
