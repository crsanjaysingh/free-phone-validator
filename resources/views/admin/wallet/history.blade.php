@extends('layouts/admin/contentNavbarLayout')

@section('title', 'Wallet History - Admin')

@section('page-script')
@endsection

@section('content')
<!-- Hoverable Table rows -->
<div class="card">
  @if ($wallet)
    <h5 class="card-header">Wallet History for {{ $wallet->user->name }} (Total Amount : ${{ $wallet->balance}})</h5>
  @else
    <h5 class="card-header">All Wallet Transactions</h5>
  @endif
  @if(Session::has('message'))
  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
  <div class="container table-responsive text-nowrap">
    <table class="table table-hover" id="walletTransactionsTable"  data-url="{{ $wallet ? route('admin.wallet.history', $wallet->user->id) : route('admin.wallet.history') }}" data-user-id="{{ $wallet->user->id ?? '' }}">
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
              <th>Action</th>
          </tr>
      </thead>
      <tbody></tbody>
  </table>
  </div>
  <!-- Modal structure -->
<div class="modal fade" id="addAmountModal" tabindex="-1" aria-labelledby="addAmountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAmountModalLabel">Update Amount to User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to add amount -->
        <form id="updateAmountForm" action="{{ route('admin.wallet.edit') }}">
          @csrf
          <input type="hidden" id="transaction_id" name="transaction_id">
          <input type="hidden" id="wallet_id"  name="wallet_id">
          <input type="hidden" id="old_amount"  name="old_amount">
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
  @vite(['resources/assets/js/admin/wallet-transactions-page.js'])
@endpush


