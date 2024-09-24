@extends('layouts/admin/contentNavbarLayout')

@section('title', 'Plan List - Admin')

@section('page-script')
@endsection

@section('content')
<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'active' => false],
  ['label' => 'Plans', 'url' => route('admin.plans.index'), 'active' => true],
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->
<!-- Hoverable Table rows -->
<div class="card">
  <div class="row">
     <div class="col-md-6"><h5 class="card-header">Plan Listing</h5></div>
     <div class="col-md-6 text-end">
         <div class="right_area">
              <a href="{{ route("admin.plans.create") }}" class="btn btn-sm btn-success">Create A Plan</a>
        </div>
     </div>
  </div>
  <div class="container table-responsive text-nowrap">
    <table id="plansTable" class="table table-hover" data-url="{{ route('admin.plans.index') }}">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Tag line</th>
            <th>Is Free</th>
            <th>Cost</th>
            <th>Plan Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
          <!-- DataTables will populate this via AJAX -->
      </tbody>
    </table>
  </div>
</div>
<!-- Modal structure -->
<div class="modal fade" id="addAmountModal" tabindex="-1" aria-labelledby="addAmountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAmountModalLabel">Add Amount to User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to add amount -->
        <form id="addAmountForm" action="{{ route('admin.wallet.add') }}">
          @csrf
          <input type="hidden" id="user_id" name="user_id">
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" min="0">
          </div>
          <div class="mb-3">
            <label for="memo" class="form-label">Memo</label>
            <textarea name="memo" id="memo" cols="30" rows="10" placeholder="Enter Memo To Remember" class="form-control"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <span class="btn btn-secondary" data-bs-dismiss="modal">Close</span>
        <button type="submit" class="btn btn-primary" id="submitAddAmount">Add Amount</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal structure -->
<!--/ Hoverable Table rows -->
@endsection
@push("styles")
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  @vite(['resources/assets/js/admin/plans-page.js'])
@endpush


