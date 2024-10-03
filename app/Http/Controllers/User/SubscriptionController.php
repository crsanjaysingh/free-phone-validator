<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\WalletService;

class SubscriptionController extends Controller
{
  public function subscribe(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'plan_id' => 'required|integer|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::with('wallet', 'subscription')->findOrFail(Auth::id());
    $wallet = $user->wallet;

    if (!$wallet) {
      return response()->json(['error' => 'Get activated your wallet by admin'], 400);
    }

    if ($user->subscription) {
      return response()->json(['error' => 'You already have an active subscription.'], 422);
    }

    $plan = Plan::findOrFail($request->plan_id);
    if (!$plan->is_free) {

      if ($user->wallet_balance < $plan->plan_cost) {
        return response()->json(['error' => 'Insufficient wallet balance to subscribe to this plan.'], 422);
      }
      $walletService = new WalletService();
      $walletService->buyItem($user, $plan->plan_cost, $plan->plan_name);

      // $user->wallet_balance -= $plan->plan_cost;
      // $user->save();
    }

    $subscription = Subscription::create([
      'user_id' => $user->id,
      'plan_id' => $plan->id,
      'lookups_remaining' => $plan->lookup_limit,
      'started_at' => Carbon::now(),
      'ends_at' => Carbon::now()->addMonth(),
    ]);

    return response()->json(['status' => 'success', 'message' => 'Subscription successful!', 'route' => route("user.plans.index")], 200);
  }

  public function changePlan(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'plan_id' => 'required|integer|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    $user = User::with('wallet', 'subscription')->findOrFail(Auth::id());
    $wallet = $user->wallet;

    if (!$wallet) {
      return response()->json(['error' => 'Get activated your wallet by admin'], 400);
    }

    if (!$user->subscription || !$user->subscription) {
      return response()->json(['error' => 'No active subscription found.'], 400);
    }

    $newPlan = Plan::findOrFail($request->plan_id);

    if (!$newPlan->is_free) {
      if ($wallet->balance < $newPlan->plan_cost) {
        return response()->json(['error' => 'Insufficient wallet balance to switch to this plan.'], 400);
      }
      $walletService = new WalletService();
      $walletService->buyItem($user, $newPlan->plan_cost, $newPlan->name);
    }

    $user->subscription->update([
      'plan_id' => $newPlan->id,
      'lookups_remaining' => $newPlan->lookup_limit,
      'started_at' => Carbon::now(),
      'ends_at' => Carbon::now()->addMonth(),
    ]);

    return response()->json(['status' => 'success', 'message' => 'Subscription plan changed successfully!', 'route' => route("user.plans.index")], 200);
  }
  public function pause(Request $request, Subscription $subscription)
  {
    if ($subscription->status == 'active') {
      $subscription->status = 2;
      $subscription->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Subscription has been paused.',
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Subscription is already paused or canceled.',
    ]);
  }

  public function cancel(Request $request, Subscription $subscription)
  {
    if (in_array($subscription->status, ['active', 'paused'])) {
      $subscription->status = 3;
      $subscription->canceled_at = now();
      $subscription->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Subscription has been canceled.',
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Subscription is already canceled.',
    ]);
  }
}
