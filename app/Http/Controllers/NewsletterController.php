<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterEmail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'subscribe-email' => 'required|email|unique:newsletter_emails,email',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    NewsletterEmail::create([
      'email' => $request->input('subscribe-email'),
      'status' => 0,
      'block' => 0,
    ]);

    return response()->json(['success' => 'Thank you for subscribing!']);
  }
}
