<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Api_key;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $apiKey = $request->header('x-api-key');

    if (!$apiKey || !Api_key::where('key', $apiKey)->exists()) {
      return response()->json(['status' => 'error', 'message' => 'API Key is wrong!'], 401);
    }
    return $next($request);
  }
}
