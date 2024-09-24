@extends('layouts/admmin/contentNavbarLayout')

@section('title', 'Create Plan - Admin')

@section('page-script')
@endsection

@section('content')

<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'active' => false],
  ['label' => 'Plans', 'url' => route('admin.plans.index'), 'active' => false],
  ['label' => 'Show', 'url' => '', 'active' => true],
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Show Plan"])
<!-- Breadcrumb Component -->

<div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Plan Info:</h5>
      </div>
      <div class="col-md-6 text-end">
        <div class="right_area">
            <!-- Link to view all plans -->
            <a href="{{ route('admin.plans.index') }}" class="btn btn-sm btn-primary">Back to Plans</a>

            <!-- Link to edit the plan -->
            <a href="{{ route('admin.plans.edit', ['plan' => $plan->id]) }}" class="btn btn-sm btn-info">Edit Plan</a>

            <!-- Toggle activation button -->
            @if ($plan->status === 1)
                <a id="deactivate_plan_{{ $plan->id }}" href="{{ route('admin.plans.toggle', ['planId' => $plan->id]) }}" class="btn btn-sm btn-warning"
                    data-plan_id="{{ $plan->id }}"
                    data-toggle_url="{{ route('admin.plans.toggle', ['planId' => $plan->id]) }}">
                    Deactivate
                </a>
            @else
                <a id="activate_plan_{{ $plan->id }}" href="{{ route('admin.plans.toggle', ['planId' => $plan->id]) }}" class="btn btn-sm btn-success"
                    data-plan_id="{{ $plan->id }}"
                    data-toggle_url="{{ route('admin.plans.toggle', ['planId' => $plan->id]) }}">
                    Activate
                </a>
            @endif

            <!-- Delete button within a form -->
            <form action="{{ route('admin.plans.destroy', ['plan' => $plan->id]) }}" method="POST" style="display: inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this plan?')">Delete Plan</button>
            </form>
        </div>
    </div>
    </div>
    <div class="card-body">
      <!-- Plan Information -->
      <div class="row">
        <div class="col-md-6">
            <p><strong>Plan Name:</strong> {{ $plan->name }}</p>
            <p><strong>Plan Tags:</strong> {{ $plan->plan_tags }}</p>
            <p><strong>Cost:</strong> ₹{{ number_format($plan->plan_cost, 2) }}</p>
            <p><strong>Type:</strong> {{ ucfirst($plan->plan_type) }}</p>
            <p><strong>Status:</strong> {{ $plan->status == 1 ? 'Active' : 'Inactive' }}</p>
            <p><strong>Is Free:</strong> {{ $plan->is_free == 1 ? 'Yes' : 'No' }}</p>
            <p><strong>Created At:</strong> {{ $plan->created_at->format('d M, Y') }}</p>
            <p><strong>Updated At:</strong> {{ $plan->updated_at->format('d M, Y') }}</p>
        </div>

        <div class="col-md-6">
            <h5>Features</h5>
            @php
                $features = json_decode($plan->features, true);
            @endphp
            <ul>
                @foreach ($features as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        </div>
    </div>
  </div>
</div>
<!--/ Hoverable Table rows -->
@endsection
@push("styles")
  <!-- Toastr CSS -->
@endpush
@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- Toastr JS -->
<script>
  var usersRoute = "{{ route('admin.users.index') }}";
</script>
  @vite(['resources/assets/js/admin/create-plan-page.js'])
@endpush


