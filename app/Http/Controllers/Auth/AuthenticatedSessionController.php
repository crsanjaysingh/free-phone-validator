<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\RecaptchaService;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Http\JsonResponse;


class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    // return view('auth.login');
    return view('frontend.new-login', ["title" => "Login Page"]);
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request, RecaptchaService $recaptchaService): RedirectResponse
  {

    if (!$recaptchaService->verify($request)) {
      return back()->withErrors(['g-recaptcha-response' => 'Invalid reCAPTCHA response.']);
    }

    $request->authenticate();

    $request->session()->regenerate();

    return redirect()->intended(route('dashboard', absolute: false));
  }

  /**
   * Handle an incoming authentication request for two factor athentication.
   */
  public function twoFactorAuth(LoginRequest $request, RecaptchaService $recaptchaService): JsonResponse
  {
    // Verify reCAPTCHA
    if (!$recaptchaService->verify($request)) {
      return response()->json([
        'status' => 'error',
        'message' => 'Invalid reCAPTCHA response.'
      ], 422);
    }

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials, $request->boolean('remember'))) {

      $otp = rand(100000, 999999);
      $user = Auth::user();

      $user->update([
        'otp' => $otp,
        'otp_expires_at' => now()->addMinutes(10),
      ]);

      Mail::to($user->email)->send(new SendOtpMail($otp));

      session(['otp_user_id' => $user->id]);

      Auth::logout();

      return response()->json([
        'status' => 'success',
        'message' => 'OTP sent successfully. Please verify.',
        'route' => route('otp.verify')
      ], 200);
    } else {
      return response()->json([
        'status' => 'error',
        'message' => trans('auth.failed')
      ], status: 401);
    }
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
