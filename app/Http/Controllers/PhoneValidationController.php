<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhoneValidationService;


class PhoneValidationController extends Controller
{
    protected $phoneValidationService;
    public function __construct(PhoneValidationService $phoneValidationService)
    {
        $this->phoneValidationService = $phoneValidationService;
    }

    public function validatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15',
        ]);

        $phone = $request->input('phone');
        $result = $this->phoneValidationService->validatePhone($phone);

        if ($result['success'] && $result['valid']) {
            return response()->json(['message' => 'Phone number is valid', 'data' => $result]);
        } else {
            return response()->json(['message' => 'Phone number is invalid', 'data' => $result], 422);
        }
    }
}
