<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PricingController extends Controller
{
  public function index()
  {
    $plans  = Plan::where("status", 1)->get();
    return view('frontend.pricing', ['title' => 'Pricing Page', 'plans' => $plans]);
  }
}
