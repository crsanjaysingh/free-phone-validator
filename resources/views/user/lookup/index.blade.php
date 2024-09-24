@extends('layouts/user/contentNavbarLayout')

@section('title', 'Recent Lookup')

@section('page-script')
@endsection

@section('content')
<!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">Lookup Listing</h5>
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


