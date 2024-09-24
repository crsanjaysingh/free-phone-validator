@extends('layouts/admin/contentNavbarLayout')

@section('title', 'Profile - Admin')

@section('page-script')
@vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="nav-align-top">
      <ul class="gap-2 mb-6 nav nav-pills flex-column flex-md-row gap-lg-0">
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="ri-group-line me-1_5"></i>Account</a></li>
      </ul>
    </div>
    <div class="mb-6 card">
      <div class="pt-0 card-body">
        <form id="adminProfileForm" method="POST" action="{{ route("admin.profile.store") }}"  enctype="multipart/form-data">
            @csrf
          <div class="mt-1 row g-5">
            <!-- Account -->
            <div class="card-body">
              <div class="gap-6 d-flex align-items-start align-items-sm-center">
                @if (!empty($user->profile_image))
                    @php
                        $imageUrl = asset('storage/' . $user->profile_image);
                    @endphp
                    <img src="{{ $imageUrl }}" alt="user-avatar" class="rounded d-block w-px-100 h-px-100" id="uploadedAvatar" />
                @else
                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="default-avatar" class="rounded d-block w-px-100 h-px-100" id="uploadedAvatar" />
                @endif

                <div class="button-wrapper">
                  <label for="upload" class="mb-4 btn btn-sm btn-primary me-3" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="ri-upload-2-line d-block d-sm-none"></i>
                    <input type="file" name="upload" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                  </label>
                  <button type="button" class="mb-4 btn btn-sm btn-outline-danger account-image-reset">
                    <i class="ri-refresh-line d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>

                  <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
              </div>
            </div>
            <!-- Account -->
            <div class="col-md-6">
              <div class="form-floating form-floating-outline error-messages">
                <input class="form-control" type="text" id="firstName" name="firstName" value="{{ $user->name??'' }}" placeholder="Enter first name" autofocus />
                <label for="firstName">First Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline error-messages">
                <input class="form-control" type="text" name="lastName" id="lastName" value="{{ $user->last_name??'' }}" placeholder="Enter last name"  />
                <label for="lastName">Last Name</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating form-floating-outline error-messages">
                <input class="form-control" type="text" id="email" name="email" value="{{ $user->email??'' }}" placeholder="Enter Email Id" />
                <label for="email">E-mail</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-merge error-messages">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ $user->phone_number??'' }}" placeholder="Enter phone number" />
                  <label for="phoneNumber">Phone Number</label>
                </div>
                <span class="input-group-text">US (+1)</span>
              </div>
            </div>
            <div class="col-md-6 d-none">
              <div class="form-floating form-floating-outline error-messages">
                <select id="country"  name="country" class="select2 form-select">
                  <option value="">Select</option>
                  <option value="Australia">Australia</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Canada">Canada</option>
                  <option value="China">China</option>
                  <option value="France">France</option>
                  <option value="Germany">Germany</option>
                  <option value="India">India</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Israel">Israel</option>
                  <option value="Italy">Italy</option>
                  <option value="Japan">Japan</option>
                  <option value="Korea">Korea, Republic of</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Russia">Russian Federation</option>
                  <option value="South Africa">South Africa</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="United States">United States</option>
                </select>
                <label for="country">Country</label>
              </div>
            </div>
          </div>
          <div class="mt-6">
            <button type="submit" class="btn btn-primary me-3">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
    <div class="card d-none">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="mb-6 form-check ms-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account" disabled="disabled">Deactivate Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push("styles")
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @vite(['resources/assets/js/admin/profile-page.js'])
@endpush

