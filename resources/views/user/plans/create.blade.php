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
  ['label' => 'Create', 'url' => route('admin.plans.create'), 'active' => true]
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->

<!-- Hoverable Table rows -->
<div class="card">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Create A Plan</h5>
      </div>
      <div class="col-md-6 text-end">
          <div class="right_area">
              <a href="{{ route("admin.plans.index") }}" class="btn btn-sm btn-success">View Plans</a>
        </div>
      </div>
    </div>
    <div class="card-body">
       <div class="row">
          <form id="planForm" action="{{ route('admin.plans.store') }}" method="POST">
              @csrf
              <div class="row">
                <div class="mb-4 form-group col-md-4">
                  <label for="name">Plan Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter plan name">
                </div>
                <div class="mb-4 form-group col-md-4">
                    <label for="plan_tags">Plan Tags</label>
                    <input type="text" class="form-control" id="plan_tags" name="plan_tags"  placeholder="Enter tag">
                </div>
                <div class="mb-4 form-group col-md-4">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="mb-4 form-group col-md-4">
                    <label for="plan_type">Plan Type</label>
                    <select class="form-control" id="plan_type" name="plan_type" required>
                        <option value="monthly" selected>Monthly</option>
                    </select>
                </div>
                <div class="mb-4 form-group col-md-4">
                  <label for="is_free">Is Free?</label>
                  <select class="form-control" id="is_free" name="is_free" required>
                      <option value="">Select</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
              </div>
              <div class="mb-4 form-group col-md-4" id="plan_cost_div">
                  <label for="plan_cost">Cost</label>
                  <input type="number" step="0.01" class="form-control" id="plan_cost" name="plan_cost" min="0" placeholder="Enter price">
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
                @endphp
                <div class="mb-4 form-group">
                  <label for="features">Features</label>
                  <select multiple class="form-control select2" id="features" name="features[]" required>
                      @foreach($availableFeatures as $feature)
                          <option value="{{ $feature }}">
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


