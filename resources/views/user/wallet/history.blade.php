@extends('layouts/user/contentNavbarLayout')

@section('title', 'Wallet History - User')

@section('page-script')
@endsection

@section('content')
<!-- Hoverable Table rows -->
<div class="card">
  {{-- <h5 class="card-header">Wallet History for User {{ $wallet->user->name }} (Total Amount : ${{ $wallet->balance}})</h5> --}}
  @if ($wallet)
    <h5 class="card-header">Wallet History for {{ $wallet->user->name }} (Total Amount : ${{ $wallet->balance}})</h5>
  @else
    <h5 class="card-header">All Wallet Transactions</h5>
  @endif
  <div class="container table-responsive text-nowrap">
    <table class="table table-hover" id="walletTransactionsTable"  data-url="{{ $wallet ? route('user.wallet.history', $wallet->user->id) : route('admin.wallet.history') }}" data-user-id="{{ $wallet->user->id ?? '' }}">
      <thead>
          <tr>
              <th>ID</th>
              @if (!$wallet)
                  <th>User</th>
              @endif
              <th>Amount</th>
              <th>Added By</th>
              <th>Memo</th>
              <th>Date</th>
              {{-- <th>Action</th> --}}
          </tr>
      </thead>
      <tbody></tbody>
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
  @vite(['resources/assets/js/user/wallet-transactions-page.js'])
@endpush


