@extends('layouts/admin/contentNavbarLayout')

@section('title', 'Create Plan - Admin')

@section('page-script')
@endsection

@section('content')

<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'active' => false],
  ['label' => 'Plans', 'url' => route('admin.plans.index'), 'active' => false],
  ['label' => 'Edit', 'url' => '', 'active' => true],
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->

<div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Update Plan</h5>
      </div>
      <div class="col-md-6 text-end">
          <div class="right_area">
            <!-- Link to view all plans -->
            <a href="{{ route('admin.plans.index') }}" class="btn btn-sm btn-primary">Back to Plans</a>

            <!-- Link to edit the plan -->
            <a href="{{ route('admin.plans.show', ['plan' => $plan->id]) }}" class="btn btn-sm btn-info">View Plan</a>

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
       <div class="row">
          <form id="planForm" action="{{ route('admin.plans.update',["plan"=> $plan->id ]) }}" method="POST">
              @method('PUT')
              <div class="row">
                <div class="mb-4 form-group col-md-4">
                  <label for="name">Plan Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter plan name" value="{{ $plan->name }}">
                </div>
                <div class="mb-4 form-group col-md-4">
                    <label for="plan_tags">Plan Tags</label>
                    <input type="text" class="form-control" id="plan_tags" name="plan_tags"  placeholder="Enter tag"  value="{{ $plan->plan_tags }}">
                </div>
                <div class="mb-4 form-group col-md-4">
                  <label for="status">Status</label>
                  <select class="form-control" id="status" name="status" required>
                      <option value="">Select</option>
                      <option value="1" {{ $plan->status == 1 ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ $plan->status == 0 ? 'selected' : '' }}>Inactive</option>
                  </select>
              </div>

              <div class="mb-4 form-group col-md-4">
                  <label for="plan_type">Plan Type</label>
                  <select class="form-control" id="plan_type" name="plan_type" required>
                      <option value="monthly" {{ $plan->plan_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                      <!-- You can add more options here -->
                  </select>
              </div>

              <div class="mb-4 form-group col-md-4">
                  <label for="is_free">Is Free?</label>
                  <select class="form-control" id="is_free" name="is_free" required>
                      <option value="">Select</option>
                      <option value="1" {{ $plan->is_free == 1 ? 'selected' : '' }}>Yes</option>
                      <option value="0" {{ $plan->is_free == 0 ? 'selected' : '' }}>No</option>
                  </select>
              </div>
                <div class="mb-4 form-group col-md-4" id="plan_cost_div" style="display:{{ $plan->is_free == 1?"none":"block" }}">
                    <label for="plan_cost">Cost</label>
                    <input type="number" step="0.01" class="form-control" id="plan_cost" name="plan_cost" min="0" placeholder="Enter price" value="{{ $plan->plan_cost }}">
                </div>

                @php
                  $availableFeatures = [
                    'Free Phone validation',
                    'Upto 10/Day',
                    'Upto 5000 Lookup/Month',
                    'Upto 5000K Lookup/Month',
                    'Upto 1M Lookup/Month',
                    'Upto 4M Lookup/Month'
                  ];
                  $selectedFeatures = is_array($plan->features) ? $plan->features : json_decode($plan->features, true);
                @endphp
                <div class="mb-4 form-group">
                  <label for="features">Features</label>
                  <select multiple class="form-control select2" id="features" name="features[]" required>
                      @foreach($availableFeatures as $feature)
                          <option value="{{ $feature }}" {{ (in_array($feature, $selectedFeatures)) ? 'selected' : '' }}>
                              {{ $feature }}
                          </option>
                      @endforeach
                  </select>
                </div>
                <div id="form-errors"></div>
              </div>

              <button type="submit" class="btn btn-primary">Save Plan</button>
           </form>
       </div>
  </div>
</div>
<!--/ Hoverable Table rows -->
@endsection
@push("styles")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- Toastr JS -->
<script>
  var plansRoute = "{{ route('admin.plans.index') }}";
</script>
  @vite(['resources/assets/js/admin/create-plan-page.js'])
  <script>
    $(document).ready(function() {
        $('#features').select2({
            placeholder: "Select Features",
            allowClear: true,
        });
    });
</script>
@endpush


