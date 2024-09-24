@extends('layouts/user/contentNavbarLayout')

@section('title', 'Plan List - User')

@section('page-script')
@endsection

@section('content')
<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('user.dashboard'), 'active' => false],
  ['label' => 'Plans', 'url' => route('user.plans.index'), 'active' => true],
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->
<!-- Hoverable Table rows -->
<div class="card">
  <div class="row">
     <div class="col-md-6"><h5 class="card-header">My Plan</h5></div>
     <div class="col-md-6 text-end">
         <div class="right_area">
              <a href="{{ route("admin.plans.create") }}" class="btn btn-sm btn-success">Buy A Plan</a>
        </div>
     </div>
  </div>
  <div class="container table-responsive text-nowrap">
    <table id="plansTable" class="table table-hover" data-url="{{ route('user.plans.index') }}">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Tag line</th>
            <th>Is Free</th>
            <th>Cost</th>
            <th>Plan Type</th>
            <th>Query Limit</th>
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
  @vite(['resources/assets/js/user/plans-page.js'])
@endpush


