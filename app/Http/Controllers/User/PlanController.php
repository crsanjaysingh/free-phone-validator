<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $plans = Plan::query();

      return DataTables::of($plans)
        ->addColumn('action', function ($plan) {
          $toggleButton = $plan->status
            ? '<a href="' . route('admin.plans.toggle', ['planId' => $plan->id]) . '"  class="btn btn-sm btn-warning">Deactivate</a> '
            : '<a href="' . route('admin.plans.toggle', ['planId' => $plan->id]) . '" class="btn btn-sm btn-success">Activate</a> ';

          $deleteButton = '
                    <form action="' . route('admin.plans.destroy', ['plan' => $plan->id]) . '" method="POST" style="display: inline-block;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this plan?\')">Delete Plan</button>
                    </form>';

          return '
                    <a href="' . route('admin.plans.show', ['plan' => $plan->id]) . '" class="btn btn-sm btn-primary">View Plan</a>
                    <a href="' . route('admin.plans.edit', ['plan' => $plan->id]) . '" class="btn btn-sm btn-info">Edit Plan</a>
                    ' . $toggleButton . '
                    ' . $deleteButton;
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

    return view('admin.plans.index');
  }



  public function create()
  {
    return view('admin.plans.create');
  }

  // Store a new plan in the database
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'plan_tags' => 'required|string|max:255',
      'features' => 'required|array',
      'is_free' => 'required|boolean',
      'plan_type' => 'required|in:days,monthly,yearly',
      'plan_cost' => $request->is_free == 0 ? 'required|numeric|min:0' : 'nullable',
    ]);

    Plan::create([
      'name' => $request->name,
      'features' => json_encode(value: $request->features),
      'plan_tags' => $request->plan_tags,
      'plan_cost' => $request->plan_cost ?? 0,
      'is_free' => $request->is_free,
      'plan_type' => $request->plan_type,
    ]);

    return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully!');
  }

  public function show($id)
  {
    $plan = Plan::findOrFail($id);

    return view('admin.plans.show', compact('plan'));
  }

  public function edit($id)
  {
    $plan = Plan::findOrFail($id);
    return view('admin.plans.edit', compact('plan'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required',
      'plan_tags' => 'required|string|max:255',
      'features' => 'required|array',
      'plan_cost' => 'required|numeric',
      'is_free' => 'required|boolean',
      'plan_type' => 'required|in:days,monthly,yearly',
      'status' => 'required'
    ]);

    $plan = Plan::findOrFail($id);
    $plan->update([
      'name' => $request->name,
      'features' => json_encode($request->features),
      'plan_tags' => $request->plan_tags,
      'cost' => $request->cost,
      'is_free' => $request->is_free,
      'plan_type' => $request->plan_type,
      'status' =>  $request->status,
    ]);
    return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully!');
  }

  public function destroy($id)
  {
    $plan = Plan::findOrFail($id);
    $plan->delete();
    return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully!');
  }

  public function toggleStatus($planId)
  {
    $plan = Plan::findOrFail($planId);
    $plan->status = !$plan->status;
    $plan->save();
    return redirect()->route('admin.plans.index')->with('success', 'Plan status updated successfully!');
  }
}
