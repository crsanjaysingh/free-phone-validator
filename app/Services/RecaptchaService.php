<?php

namespace App\Services;

use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

class RecaptchaService
{
  private $recaptcha;

  public function __construct()
  {
    $this->recaptcha = new ReCaptcha(config('services.recaptcha.secret_key'));
  }

  public function verify(Request $request)
  {
    $response = $this->recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

    return $response->isSuccess();
  }
}
