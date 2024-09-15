<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\RecaptchaService;
use Illuminate\Http\JsonResponse;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    // return view('auth.register');

    return view('frontend.new-register', ['title' => 'Register']);
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request, RecaptchaService $recaptchaService): JsonResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    if (!$recaptchaService->verify($request)) {
      return response()->json([
        'status' => 'error',
        'message' => $request->input('g-recaptcha-response') ? "please wait, the page is loading" : "Invalid reCAPTCHA response."
      ], 422);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    event(new Registered(user: $user));
    Auth::login($user);
    return redirect()->route('verification.notice');
  }
}
