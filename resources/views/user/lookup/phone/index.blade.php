@extends('layouts/user/contentNavbarLayout')

@section('title', 'Recent Lookup')

@section('page-script')
@endsection

@section('content')

<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('user.dashboard'), 'active' => false],
  ['label' => 'Recent Lookups', 'url' => route('user.plans.index'), 'active' => true]
];
@endphp
@include('components.user.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->

<!-- Hoverable Table rows -->
<div class="card">
  <div class="row">
    <div class="col-md-6 text-start">
      <h5 class="card-header">Lookup Listing</h5>
    </div>
    <div class="mt-3 col-md-6 text-end">
      <a href="{{ route("dashboard") }}" class="btn btn-success" style="margin-right:24px">View Lookup API</a>
    </div>
  </div>
  <div class="container table-responsive text-nowrap">
    <table id="lookupTable" class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Lookup Type</th>
            <th>Lookup For</th>
            <th>Fraud Score</th>
            <th>Status</th>
            <th>Country</th>
            <th>User</th>
            <th>Created At</th>
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
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  var lookupRoute = "{{ route('user.lookup.index') }}";
</script>
  @vite(['resources/assets/js/user/lookup-page.js'])
@endpush


