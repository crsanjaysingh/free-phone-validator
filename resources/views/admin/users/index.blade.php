@extends('layouts/admin/contentNavbarLayout')

@section('title', 'Users List - Admin')

@section('page-script')
@endsection

@section('content')
<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'active' => false ],
  ['label' => 'Users', 'url' => route('admin.users.index'), 'active' => true],
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->
<!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">Users Listing</h5>
  <div class="container table-responsive text-nowrap">
    <table id="usersTable" class="table table-hover">
        <thead>
          <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>status</th>
              <th>Is Deleted</th>
              <th>Is Blocked</th>
              <th>Action</th>
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
<script>
  var usersRoute = "{{ route('admin.users.index') }}";
</script>
  @vite(['resources/assets/js/admin/users-page.js'])
@endpush


