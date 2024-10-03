<?php

namespace App\Services;

use App\Models\Api_key;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiKeyService
{
  public function getToken($sanctum = false)
  {
    try {

      // Get the currently authenticated user
      $user = Auth::user();
      if (!$user) {
        return response()->json([
          'status' => 'error',
          'message' => 'Unauthorized',
        ], 401);
      }

      // Check if user already has an existing token
      $existingToken = Api_key::where("user_id", $user->id)->first();

      if ($existingToken) {
        return [
          'status' => 'success',
          'access_token' => $existingToken->key,
          'token_type' => 'Bearer',
        ];
      }

      // Generate a unique token
      do {
        $token = Str::random(32);
        $tokenExists = Api_key::where("key", $token)->exists();
      } while ($tokenExists);

      // Store the new token in the database
      Api_key::create([
        'user_id' => $user->id,
        'key' => $token,
      ]);

      // Return the new token in the response
      return [
        'status' => 'success',
        'access_token' => $token,
        'token_type' => 'Bearer',
      ];
    } catch (\Throwable $th) {
      // Return a proper error response
      return [
        'status' => 'error',
        'message' => 'An error occurred while generating the token.',
        'error' => $th->getMessage(),
      ];
    }
  }
}
