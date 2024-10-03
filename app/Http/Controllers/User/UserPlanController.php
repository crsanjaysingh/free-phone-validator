<?php

namespace App\Http\Controllers\User;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPlanController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    $subscription = Subscription::where("user_id", $user->id)->with('user', 'plan')->first();
    return view('user.plans.index', ["subscription" => $subscription]);
  }

  public function planStatus(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'subscriptionId' => 'required|integer|max:255',
        'subscriptionStatus' => 'required|integer|max:255',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
      }

      $user = Auth::user();

      $subscription = Subscription::where("user_id", $user->id)->where("id", $request->subscriptionId)->first();

      if (!$subscription) {
        return response()->json(['status' => 'error', 'message' => 'Subscription not found'], 404);
      }

      $subscription->status = $request->subscriptionStatus;
      $subscription->save();

      $message = '';
      if ($request->subscriptionStatus == 1) {
        $message = 'Subscription is continued';
      } elseif ($request->subscriptionStatus == 2) {
        $message = 'Subscription is paused';
      } elseif ($request->subscriptionStatus == 3) {
        $message = 'Subscription is cancelled';
      }

      return response()->json(['status' => 'success', 'message' => $message, 'route' => route("user.plans.index")], 200);
    } catch (\Exception $e) {
      dd($e->getMessage());
      return response()->json([
        'status' => 'error',
        'message' => 'An error occurred while processing the request',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
