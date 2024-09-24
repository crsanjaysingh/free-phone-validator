<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Yajra\DataTables\Facades\DataTables;

class UserPlanController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $plans = Plan::query();

      return DataTables::of($plans)
        ->addColumn('action', function ($plan) {
          return '
                    <a href="' . route('user.plans.show', ['plan' => $plan->id]) . '" class="btn btn-sm btn-primary">View Plan</a>
                    <a href="' . route('user.plans.edit', ['plan' => $plan->id]) . '" class="btn btn-sm btn-info">Upgrade</a>
                    ';
        })
        ->editColumn('plan_cost', function ($plan) {
          return '$' . number_format($plan->plan_cost, 2);
        })
        ->editColumn('status', function ($plan) {
          return $plan->status ? 'Active' : 'Inactive';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('user.plans.index');
  }
}
