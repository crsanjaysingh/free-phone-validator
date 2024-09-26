<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $user = Auth::user();

    if ($user && $user->hasRole('admin')) {
      return redirect()->route('admin.dashboard');
    } else if ($user && $user->hasRole('user')) {
      return redirect()->route('user.dashboard');
    } else {
      return redirect()->route('home');
    }
  }
}
