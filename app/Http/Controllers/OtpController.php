<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
  public function show()
  {
    return view('auth.otp-verify');
  }

  public function verify(Request $request)
  {
    $request->validate([
      'otp' => 'required|numeric|digits:6',
    ]);

    $user = User::find(session('otp_user_id'));

    if (!$user) {
      return redirect()->route('login')->withErrors('Session expired, please login again.');
    }

    $otpExpiresAt = Carbon::parse($user->otp_expires_at);

    if ($user->otp === $request->otp && $otpExpiresAt->isFuture()) {

      Auth::login($user);
      $request->session()->regenerate();

      $user->update([
        'otp' => null,
        'otp_expires_at' => null,
      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'OTP verification is done!.',
        'route' => route('dashboard')
      ], 200);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Invalid OTP or OTP expired.',
      'route' => route('otp.verify')
    ], 422);
  }
}
