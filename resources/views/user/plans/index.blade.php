@extends('layouts/user/contentNavbarLayout')

@section('title', 'Plan List - User')

@section('page-script')
@endsection

@section('content')
<!-- Breadcrumb Component -->
@php
$breadcrumbs = [
  ['label' => 'Dashboard', 'url' => route('user.dashboard'), 'active' => false],
  ['label' => 'Subscription', 'url' => route('user.plans.index'), 'active' => true],
];
@endphp
@include('components.admin.breadcrumb', ['title' => 'Dashboard', 'breadcrumbs' => $breadcrumbs, 'styleClass' => 'breadcrumb-style1', 'cardHeader'=>false, 'cardHeaderHeading'=>"Edit Plan"])
<!-- Breadcrumb Component -->
<!-- Hoverable Table rows -->
<div class="mt-4 mb-4 text-center shadow-lg card subscription-card">
  <div class="card-header bg-primary">
    <h5 class="mb-0 text-white card-title">Subscription Details</h5>
  </div>
  <div class="card-body">
      <div class="pt-5">
         @include('components.user.subscription-info', ['subscription' => $subscription])
      </div>
  </div>
</div>
@endsection
@push("styles")
<style>
  .subscription-card {
    border-radius: 10px;
  }
  .subscription-card .card-header {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  .subscription-card .card-body h6 {
    font-weight: bold;
    color: #555;
  }
</style>
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


